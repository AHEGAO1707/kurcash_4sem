<template>
  <div id="app">
    <div id="nav" class="header">
      <a href="https://github.com/AHEGAO1707/kurcash_4sem"><img width="60" src="./assets/github.png"></a>
      <router-link class="nav__element" to="/">О сайте</router-link>

      <router-link class="nav__element" id="Login" style="display: inline" to="/login">Авторизироваться</router-link>

      <router-link class="nav__element" id="Regis" style="display: inline" to="/register">Зарегистрироваться</router-link>

      <router-link class="nav__element" id="Admin" style="display: inline" to="/loginAdmin">Для администратора</router-link>

      <router-link class="nav__element" id="MainAdmin" style="display: inline" to="/loginMainAdmin">Для главного администратора</router-link>

      <router-link class="nav__element" id="Admin_page" style="display: none" to="/admin">Личный кабинет администратора</router-link>

      <router-link class="nav__element" id="Main_Admin_page" style="display: none" to="/mainAdmin">Личный кабинет главного администратора</router-link>

      <router-link class="nav__element" id="Home" style="display: none" to="/home">Таск-трекер</router-link>

      <label id="Name_Surname" class="nav__element" style="display: none" ></label>

      <router-link class="nav__element" id="LichnKab" style="display: none" to="/changePass">Личный кабинет</router-link>

      <button id="Exit" style="display: none" class="nav__cool-button" type="button" @click="exit">Выйти</button>

    </div>
    <router-view/>
  </div>
</template>
<script>

import router from "./router/router";

export default {
  methods: {
    exit: function () {
      let this_Comp = this;
      this_Comp.$store.commit('SET_ID', "");
      this_Comp.$store.commit('SET_Name', "");
      this_Comp.$store.commit('SET_Surname', "");
      this_Comp.$store.commit('SET_Is_Auth', false);

      document.getElementById('Name_Surname').innerHTML = "";
      document.getElementById('Name_Surname').style.display = "none";
      document.getElementById('LichnKab').style.display = "none";

      document.getElementById('Login').style.display = "inline";
      document.getElementById('Regis').style.display = "inline";
      document.getElementById('Admin').style.display = "inline";
      document.getElementById('MainAdmin').style.display = "inline";

      document.getElementById('Exit').style.display = "none";
      document.getElementById('Admin_page').style.display = "none";
      document.getElementById('Main_Admin_page').style.display = "none";
      document.getElementById('Home').style.display = "none";

      router.replace('/');
    },


  }
}
</script>


<style>
:root {
  --color-title-gray: #7f7f7f;
  --color-base-blue: black;
  --color-background-blue: #d4d4d4;
  --color-life-dark: #36556c;
  --color-background: white;
}

body {
  height: 100%;
  margin: 0;
  background-color: var(--color-background);
}

#app {
  max-width: 90%;
  margin: 0 auto;
}

.header {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  min-height: 75px;
  height: max-content;
  background-color: white;
  border-bottom-left-radius: 15px;
  border-bottom-right-radius: 15px;
  border: 1px black solid;
  flex-wrap: wrap;
}

.nav__element{
  color: black;
  text-decoration: none;
  font-size: 1.5em;
  padding: 5px;
}

.nav__cool-button{
  border-radius: 10px;
  display: none;
  font-size: 1.5em;
  background-color: #ccffd3;
}

.edit-schema p {
  color: var(--color-title-gray);
  margin-right: 5px;
  font-size: 16px;
}

.title-kanban h1 {
  font-size: 40px;
  color: var(--color-title-gray);
}

@media (max-width: 400px) {

  .edit-schema p {
    margin-right: 0;
  }
}

</style>


