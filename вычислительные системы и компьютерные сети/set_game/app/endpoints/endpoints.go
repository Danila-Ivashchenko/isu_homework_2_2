package endpoints

import (
	"fmt"
	"net/http"
	db "set-game/app/database"
	m "set-game/app/models"

	"github.com/gorilla/websocket"
	"github.com/labstack/echo/v4"
)

// func readBody(с echo.Context) ([]byte, error) {
// 	bytes := []byte{}
// 	_, err := с.Request().Body.Read(bytes)
// 	if err != nil {
// 		return nil, err
// 	}

// 	return bytes, nil
// }

type Endpoints struct{}

func (endp *Endpoints) Register(с echo.Context) error {
	request := m.RegRequest{}
	err := с.Bind(&request)
	if err != nil {
		return с.JSON(http.StatusOK, m.NewRegResponseBad(map[string]interface{}{"message": err.Error()}))
	}
	if db.Users[request.Nickname] != "" {
		return с.JSON(http.StatusOK, m.NewRegResponseBad(map[string]interface{}{"message": "This user is already registrated"}))
	}
	//registerUser(request)
	user := m.NewUser(request)
	db.RegisterUser(user)
	return с.JSON(http.StatusOK, m.NewRegResponseOk(user))
}

func (endp *Endpoints) Create(c echo.Context) error {
	tocken := m.RequestWithTocken{}
	c.Bind(&tocken)

	flag, _ := db.CheckTocken(tocken.AccessToken)
	if !flag {
		return c.JSON(http.StatusOK, m.CreateResponse{Success: false, Exception: map[string]interface{}{"message": "Wrong Access Tocken"}})
	}

	id, lobby := db.NewLobby()
	db.Lobbies[id] = lobby
	return c.JSON(http.StatusOK, m.CreateResponse{Success: true, GameId: id})
}

func (endp *Endpoints) GetLobbies(с echo.Context) error {
	return с.JSON(http.StatusOK, db.GetLobbies())
}

func (endp *Endpoints) GetLobbiesInfo(с echo.Context) error {
	return с.JSON(http.StatusOK, db.Lobbies)
}

func (endp *Endpoints) JoinToGame(с echo.Context) error {
	request := m.JoinRequest{}
	с.Bind(&request)
	return с.JSON(http.StatusOK, db.EnterGame(request.AccessToken, request.GameId))
}

func (endp *Endpoints) GetUsers(с echo.Context) error {
	return с.JSON(http.StatusOK, db.Users)
}

func (endp *Endpoints) GetPlayers(с echo.Context) error {
	return с.JSON(http.StatusOK, db.PlayerDatas)
}

func (endp *Endpoints) Field(с echo.Context) error {
	accessTocken := m.RequestWithTocken{}
	с.Bind(&accessTocken)
	pd, flag := db.PlayerDatas[accessTocken.AccessToken]
	exaption := map[string]interface{}{}
	if !flag {
		exaption["mess"] = fmt.Sprintf("bad access token - %s", accessTocken.AccessToken)
		return с.JSON(http.StatusOK, m.BadCardsResponse(exaption))
	}
	gameId := pd.CurrentLobby
	_, flag = db.Lobbies[gameId]
	if !flag {
		exaption["mess"] = fmt.Sprintf("Bad lobby id - %d", gameId)
		return с.JSON(http.StatusOK, m.BadCardsResponse(exaption))
	}

	return с.JSON(http.StatusOK, m.GoodCardsResponse(db.Lobbies[gameId].ActiveCards))
}

func (endp *Endpoints) AddCards(с echo.Context) error {
	accessTocken := m.RequestWithTocken{}
	с.Bind(&accessTocken)
	pd, flag := db.PlayerDatas[accessTocken.AccessToken]
	exaption := map[string]interface{}{}
	if !flag {
		exaption["message"] = fmt.Sprintf("bad access token - %s", accessTocken.AccessToken)
		return с.JSON(http.StatusOK, m.BadCardsResponse(exaption))
	}
	gameId := pd.CurrentLobby
	lobby, flag := db.Lobbies[gameId]
	if !flag {
		exaption["message"] = fmt.Sprintf("Bad lobby id - %d", gameId)
		return с.JSON(http.StatusOK, m.BadCardsResponse(exaption))
	}
	flag, mess := lobby.MakeActiveCards(3)
	db.Lobbies[gameId] = lobby
	if !flag {
		exaption["message"] = mess
		return с.JSON(http.StatusOK, m.MixedCardsResponse(db.Lobbies[gameId].ActiveCards, exaption))
	}
	db.Lobbies[gameId] = lobby
	return с.JSON(http.StatusOK, m.GoodCardsResponse(db.Lobbies[gameId].ActiveCards))
}

func (endp *Endpoints) FindSet(с echo.Context) error {
	accessTocken := m.RequestWithTocken{}
	с.Bind(&accessTocken)
	pd, flag := db.PlayerDatas[accessTocken.AccessToken]
	exaption := map[string]interface{}{}
	if !flag {
		exaption["message"] = fmt.Sprintf("bad access token - %s", accessTocken.AccessToken)
		return с.JSON(http.StatusOK, m.BadCardsResponse(exaption))
	}
	gameId := pd.CurrentLobby
	lobby, flag := db.Lobbies[gameId]
	if !flag {
		exaption["message"] = fmt.Sprintf("Bad lobby id - %d", gameId)
		return с.JSON(http.StatusOK, m.BadCardsResponse(exaption))
	}
	flag, mess, set := lobby.FindSet()
	db.Lobbies[gameId] = lobby
	if !flag {
		exaption["mess"] = mess
		return с.JSON(http.StatusOK, m.MixedCardsResponse(set, exaption))
	}

	return с.JSON(http.StatusOK, m.GoodCardsResponse(set))
}

func (endp *Endpoints) Pick(c echo.Context) error {
	request := m.PickRequest{}
	c.Bind(&request)
	pd, flag := db.PlayerDatas[request.AccessToken]
	exaption := map[string]interface{}{}
	if !flag {
		exaption["message"] = fmt.Sprintf("bad access token - %s", request.AccessToken)
		return c.JSON(http.StatusOK, m.NewPickResponse(flag, exaption, -1))
	}
	gameId := pd.CurrentLobby
	lobby, flag := db.Lobbies[gameId]
	if !flag {
		exaption["message"] = fmt.Sprintf("Bad lobby id - %d", gameId)
		return c.JSON(http.StatusOK, m.NewPickResponse(flag, exaption, -1))
	}
	flag, mess := lobby.Pick(request.Cards...)
	if flag {
		pd.Score += 1
		db.PlayerDatas[request.AccessToken] = pd
	}
	exaption["message"] = mess
	db.Lobbies[gameId] = lobby
	return c.JSON(http.StatusOK, m.NewPickResponse(flag, exaption, pd.Score))
}

func (endp *Endpoints) SayToConns(с echo.Context) error {
	mess := []byte{}
	body := с.Request().Body
	body.Read(mess)
	for conn := range db.Conns {
		conn.WriteMessage(websocket.BinaryMessage, mess)
	}
	return nil
}
