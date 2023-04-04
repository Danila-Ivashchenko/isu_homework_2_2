package models

type RegRequest struct {
	Nickname string `json:"nickname"`
	Password string `json:"password"`
}

type RegResponse struct {
	Exaption map[string]interface{} `json:"exaption"`
	Nickname string                 `json:"nickname"`
	Password string                 `json:"password"`
}
