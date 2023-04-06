package main

import (
	a "set-game/app/application"
	e "set-game/app/endpoints"
	g "set-game/app/game"
)

func main() {
	endp := new(e.Endpoints)
	g := new(g.Game)
	app := a.NewApp(endp, g)
	app.Engine("8080")
}
