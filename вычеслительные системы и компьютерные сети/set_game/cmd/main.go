package main

import (
	a "set-game/app/application"
	e "set-game/app/endpoints"
)

func main() {
	endp := new(e.Endpoints)
	app := a.NewApp(endp)
	app.Engine("8080")
}
