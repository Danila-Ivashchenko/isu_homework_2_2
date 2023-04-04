package application

import (
	"github.com/labstack/echo/v4"
)

type IEndpoints interface {
	Register(c echo.Context) error
	GetUsers(c echo.Context) error
	// Create(e echo.Context) error
	// List(e echo.Context) error
	// Enter(e echo.Context) error
	// Field(e echo.Context) error
	// Pick(e echo.Context) error
}

const (
	user = "/user"
)

type App struct {
	e    *echo.Echo
	endp IEndpoints
	//groups map[string]echo.Group
}

// func (app *App) fillGroups() {
// 	app.groups["user"] = *app.e.Group(user)
// }

func NewApp(endp IEndpoints) *App {
	app := new(App)
	app.e = echo.New()
	app.endp = endp

	//app.fillGroups()
	app.routing()
	return app
}

func (app *App) routing() {
	app.e.POST("/user/register", app.endp.Register)
	app.e.POST("/user/get_all", app.endp.GetUsers)
}

// Get port like "8080", not ":8080"
func (app *App) Engine(port string) {
	app.e.Logger.Fatal(app.e.Start(":" + port))
}
