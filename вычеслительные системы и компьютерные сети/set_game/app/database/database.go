package database

import "github.com/gorilla/websocket"

var (
	Users = map[string]string{}
	Conns = map[*websocket.Conn]bool{}
)
