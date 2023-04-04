package endpoints

import (
	"net/http"
	db "set-game/app/database"
	m "set-game/app/models"

	"github.com/labstack/echo/v4"
)

func readBody(с echo.Context) ([]byte, error) {
	bytes := []byte{}
	_, err := с.Request().Body.Read(bytes)
	if err != nil {
		return nil, err
	}

	return bytes, nil
}

type Endpoints struct{}

func (endp *Endpoints) Register(с echo.Context) error {
	// body, err := readBody(с)
	// if err != nil {
	// 	return с.JSON(http.StatusOK, m.RegResponse{Exaption: map[string]interface{}{"message": err.Error(), "stage": 0}})
	// }
	// request := m.RegRequest{}
	// err = json.Unmarshal(body, &request)
	request := m.RegRequest{}
	err := с.Bind(&request)
	if err != nil {
		return с.JSON(http.StatusOK, m.RegResponse{Exaption: map[string]interface{}{"message": err.Error(), "stage": 1}, Nickname: request.Nickname, Password: request.Password})
	}
	db.Users[request.Nickname] = request.Password
	return с.JSON(http.StatusOK, m.RegResponse{Nickname: request.Nickname, Password: request.Password})
}

func (endp *Endpoints) GetUsers(с echo.Context) error {
	return с.JSON(http.StatusOK, db.Users)
}
