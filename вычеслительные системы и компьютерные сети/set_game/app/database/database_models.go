package database

import (
	set_m "set-game/set/models"
)

type ErrAnswer struct {
	mess string
}

func (err *ErrAnswer) Error() string {
	return err.mess
}

type Lobby struct {
	MaxPlayers   int          `json:"max_players"`
	Players      []string     `json:"players"`
	Cards        []set_m.Card `json:"-"`
	CountPlayers int          `json:"count_players"`
}

type LobbyEnterResponce struct {
	Success  bool                   `json:"success"`
	Exaption map[string]interface{} `json:"exaption"`
	GameId   int                    `json:"gameId"`
}

type PlayerData struct {
	UserName     string
	CurrentLobby int
}
