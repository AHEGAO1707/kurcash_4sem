<template>
  <div>
    <form v-on:submit.prevent="onSubmit" class="cool-form">
      <h1>Регистрация</h1>
      <div>
        <p><label>Укажите имя и фамилию: </label></p>
        <input class="input-cool" id="name" type="text" v-model="name" placeholder="Имя" required autofocus>
        <input class="input-cool" id="surname" type="text" v-model="surname" placeholder="Фамилия" required>
      </div>
      <div>
        <p><label>Укажите адрес электронной почты: </label></p>
        <input class="input-cool" id="inpEmail" type="email" v-model="email" placeholder="Адрес электронной почты" required>
      </div>
      <div>
        <p><label>Придумайте пароль: </label></p>
        <input class="input-cool" id="inpPass" type="password" placeholder="Пароль" v-model="password" required>
      </div>
      <div>
        <p><label>Повторите пароль: </label></p>
        <input class="input-cool" id="inpPassCon" type="password" placeholder="Повтор пароля" v-model="password_confirmation" required>
      </div>
      <hr/>
      <div>
        <button class="cool-button"  type="button" id="butReg" @click="reg">Зарегистрироваться</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import router from '../router/router'
import Swal from "sweetalert2";


export default {
  data() {
    return {
      name: "",
      surname: "",
      email: "",
      password: "",
      password_confirmation: "",
      is_admin: null
    }
  },

  methods: {
    reg: function () {
      let name = this.name;
      let surname = this.surname;
      let email = this.email;
      let pass = this.password;
      let passConf = this.password_confirmation;

      if (name !== "" && surname !== "" && email !== "" && pass !== "" && pass !== "") {
        if (pass === passConf) {
          let params = {
            name: `${name}`,
            surname: `${surname}`,
            email: `${email}`,
            pass: `${pass}`
          };

          console.log(params)//проверка введеных параметров

          axios
              .get("http://localhost/registration.php", {params})

              .then(function (response) {

                console.log(response.data.result); //вывод в консоль информации об успешности регистрации

                if (response.data.result) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Успех!',
                    text: 'Вы успешно зарегистрировались! Вы будете перенаправлены на страницу авторизации',
                  })
                  router.replace('login')
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Произошла ошибка!',
                    text: 'Проверьте правильность введённых данных. Возможно, на эту почту уже зарегистрирован другой пользователь.',
                  })
                }

              });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Упс...',
            text: 'Ваши пароли не совпадают!',
          })
        }
      }
      else {
        Swal.fire({
          icon: 'error',
          title: 'Пожалуйста...',
          text: 'Заполните все поля!',
        })
      }
    },
  }
}
</script>
