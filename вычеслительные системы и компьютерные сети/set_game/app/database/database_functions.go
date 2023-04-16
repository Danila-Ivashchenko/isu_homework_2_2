package database

import (
	app_m "set-game/app/models"
	f "set-game/set/functions"
	set_m "set-game/set/models"
)

func RegisterUser(user app_m.User) {
	AccessTokens[user.AccessToken] = user.Nickname
	Users[user.Nickname] = user.AccessToken
}

func AddPlayer(username string, currentLobby int) PlayerData {
	pd := PlayerData{}
	pd.UserName = username
	pd.CurrentLobby = currentLobby
	return pd
}

func CheckTocken(tocken string) (bool, string) {
	val, ok := AccessTokens[tocken]
	return ok, val
}

func CheckUserInGames(username string) bool {
	for _, lobby := range Lobbies {
		for _, value := range lobby.Players {
			if value == username {
				return true
			}
		}
	}
	return false
}

func GetLobbies() map[string][]map[string]int {
	games := []map[string]int{}
	for key := range Lobbies {
		games = append(games, map[string]int{"gameId": key})
	}
	return map[string][]map[string]int{"games": games}
}

func EnterGame(accessTocken string, gameId int) LobbyEnterResponce {
	_, flag := Lobbies[gameId]
	if !flag {
		return BadLobbyEnterResponce(map[string]interface{}{"message": "This lobby is not exist"})
	}
	username := AccessTokens[accessTocken]
	if CheckUserInGames(username) {
		return BadLobbyEnterResponce(map[string]interface{}{"message": "You are in the other lobby"})
	}
	var err error
	Lobbies[gameId], err = JoinToLobby(Lobbies[gameId], username)
	if err != nil {
		return BadLobbyEnterResponce(map[string]interface{}{"message": err.Error()})
	}
	PlayerDatas[accessTocken] = AddPlayer(username, gameId)

	return GoodLobbyEnterResponce(gameId)
}

func BadLobbyEnterResponce(exaption map[string]interface{}) LobbyEnterResponce {
	ler := LobbyEnterResponce{}
	ler.Success = false
	ler.Exaption = exaption
	ler.GameId = -1
	return ler
}

func GoodLobbyEnterResponce(gameId int) LobbyEnterResponce {
	ler := LobbyEnterResponce{}
	ler.Success = true
	ler.GameId = gameId
	return ler
}

func NewLobby() (int, Lobby) {
	l := Lobby{}
	l.MaxPlayers = maxPlayers
	l.Players = make([]string, maxPlayers)
	l.CountPlayers = 0
	l.Cards = f.GenerateBoard()

	id := LobbiesCount
	LobbiesCount++
	return id, l
}

func JoinToLobby(l Lobby, user string) (Lobby, error) {
	if l.CountPlayers >= l.MaxPlayers {
		return l, &ErrAnswer{mess: "This lobby is full"}
	}
	for _, value := range l.Players {
		if value == user {
			return l, &ErrAnswer{mess: "You are already in the lobby"}
		}
	}
	l.Players[l.CountPlayers] = user
	l.CountPlayers++

	return l, nil
}

func (l *Lobby) GetNCards(n int) (map[string][]set_m.Card, bool) {
	if n > len(l.Cards) {
		return map[string][]set_m.Card{"cards": []set_m.Card{}}, false
	}
	cards := make([]set_m.Card, n)
	for i := 0; i < n; i++ {
		cards[i] = l.Cards[i]
	}
	l.Cards = l.Cards[n:]
	return map[string][]set_m.Card{"cards": cards}, true
}
