package game

import (
	"fmt"
	db "set-game/app/database"

	"github.com/gorilla/websocket"
	"github.com/labstack/echo/v4"
)

type Game struct {
	upgrader websocket.Upgrader
}

func NewGame() *Game {
	g := new(Game)
	g.upgrader = websocket.Upgrader{}
	return g
}

func (g *Game) Hello(c echo.Context) error {
	ws, err := g.upgrader.Upgrade(c.Response(), c.Request(), nil)
	if err != nil {
		c.Logger().Error(err)
		return err
	}

	func() {
		db.Conns[ws] = true
		var err error
		var mess []byte

		defer c.Logger().Error(err)
		defer delete(db.Conns, ws)
		defer ws.Close()

		for {
			err = ws.WriteMessage(websocket.TextMessage, []byte("hello client!"))
			if err != nil {
				break
			}

			_, mess, err = ws.ReadMessage()
			if err != nil {
				break
			}
			fmt.Println(string(mess))
		}
	}()
	return nil
}
