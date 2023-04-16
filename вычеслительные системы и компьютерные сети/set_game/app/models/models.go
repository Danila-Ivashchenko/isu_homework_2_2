package models

import (
	"crypto/md5"
	"encoding/hex"

	"golang.org/x/crypto/bcrypt"
)

func generateToken(username string) string {
	hash, _ := bcrypt.GenerateFromPassword([]byte(username), bcrypt.DefaultCost)

	hasher := md5.New()
	hasher.Write(hash)
	return hex.EncodeToString(hasher.Sum(nil))
}

type RegRequest struct {
	Nickname string `json:"nickname"`
	Password string `json:"password"`
}

type User struct {
	Nickname    string `json:"nickname"`
	AccessToken string `json:"accessToken"`
}

func NewUser(request RegRequest) User {
	return User{Nickname: request.Nickname, AccessToken: generateToken(request.Nickname)}
}

type RegResponse struct {
	Success     bool                   `json:"success"`
	Exaption    map[string]interface{} `json:"exaption"`
	Nickname    string                 `json:"nickname"`
	AccessToken string                 `json:"accessToken"`
}

func NewRegResponseBad(exaption map[string]interface{}) RegResponse {
	respose := RegResponse{}
	respose.Exaption = exaption
	respose.Success = false
	return respose
}

func NewRegResponseOk(user User) RegResponse {
	respose := RegResponse{}
	respose.Nickname = user.Nickname
	respose.AccessToken = user.AccessToken
	respose.Success = true
	return respose
}

type RequestWithTocken struct {
	AccessToken string `json:"accessTocken"`
}

type CreateResponse struct {
	Success   bool                   `json:"success"`
	Exception map[string]interface{} `json:"exception"`
	GameId    int                    `json:"gameId"`
}

type JoinRequest struct {
	AccessToken string `json:"accsessTocken"`
	GameId      int    `json:"gameId"`
}
