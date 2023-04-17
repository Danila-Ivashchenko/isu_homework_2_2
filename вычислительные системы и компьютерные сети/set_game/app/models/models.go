package models

import (
	"crypto/md5"
	"encoding/hex"
	set_m "set-game/set/models"

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

type CardsResponse struct {
	Success   bool                   `json:"success"`
	Exception map[string]interface{} `json:"exception"`
	Cards     []set_m.Card           `json:"cards"`
}

func BadCardsResponse(exaption map[string]interface{}) CardsResponse {
	respnose := CardsResponse{}
	respnose.Success = false
	respnose.Exception = exaption
	return respnose
}

func GoodCardsResponse(cards []set_m.Card) CardsResponse {
	respnose := CardsResponse{}
	respnose.Success = true
	respnose.Cards = cards
	return respnose
}

func MixedCardsResponse(cards []set_m.Card, exaption map[string]interface{}) CardsResponse {
	respnose := CardsResponse{}
	respnose.Success = true
	respnose.Exception = exaption
	respnose.Cards = cards
	return respnose
}

type PickRequest struct {
	AccessToken string `json:"accessTocken"`
	Cards       []int  `json:"cards"`
}
