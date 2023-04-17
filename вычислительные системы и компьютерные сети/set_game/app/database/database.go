package database

import (
	"github.com/gorilla/websocket"
)

const (
	maxPlayers int = 10
)

var (
	LobbiesCount = 0
	Users        = map[string]string{}
	AccessTokens = map[string]string{}
	Conns        = map[*websocket.Conn]bool{}
	Lobbies      = map[int]Lobby{}
	PlayerDatas  = map[string]PlayerData{}
)
