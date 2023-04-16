package endpoints

import (
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
	if !flag {
		return с.JSON(http.StatusOK, map[string]interface{}{"cards": []interface{}{}})
	}
	gameId := pd.CurrentLobby
	lobby, flag := db.Lobbies[gameId]
	if !flag {
		return с.JSON(http.StatusOK, map[string]interface{}{"cards": []interface{}{}})
	}
	cards, _ := lobby.GetNCards(12)
	db.Lobbies[gameId] = lobby
	return с.JSON(http.StatusOK, cards)
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
