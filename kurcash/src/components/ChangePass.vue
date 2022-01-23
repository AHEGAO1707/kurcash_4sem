<template>
  <div>
    <form  v-on:submit.prevent="onSubmit" class="cool-form" >
      <h1>Смена пароля</h1>
      <div>
        <p><label>Введите текущий пароль: </label></p>
        <input class="input-cool" id="inpCurrPass" required v-model="password" type="password" placeholder="Текущий пароль"/>
      </div>
      <div>
        <p><label>Введите новый пароль: </label></p>
        <input class="input-cool" id="inpNewPass" required v-model="password" type="password" placeholder="Введите новый пароль"/>
      </div>
      <hr>
      <div>
        <button class="cool-button"  type="button" id="butChangePass" @click="changePas">Сменить пароль</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from "sweetalert2";
import router from "../router/router";

export default {
  data() {
    return {
      nowPass: "",
      id: "",
      newPass: "",
    }
  },

  methods: {

    changePas: function () {
      let nowPas = document.getElementById("inpCurrPass").value;
      let newPas = document.getElementById("inpNewPass").value;

      let this_Comp = this;
      let id = this_Comp.$store.getters.GET_ID;

      let params = {id: `${id}`, nowPass: `${nowPas}`};

      axios
          .get("http://localhost/checkPass.php", {params})

          .then(function (response) {

            console.log(response.data.result);

            if (response.data.result) {


              if (response.data.pass == newPas) {
                Swal.fire({
                  icon: 'info',
                  title: 'Внимание',
                  text: 'Новый пароль не может совпадать со старым. Введите новый пароль, пожалуйста!',
                })
              }

              else {
                let params = {id: `${id}`, newPass: `${newPas}`};
                axios
                .get("http://localhost/setNewPass.php", {params})
                    /*.then(function (response) {
                      if (response.data.result) {
                        Swal.fire({
                          icon: 'success',
                          title: 'Успех',
                          text: 'Пароль был успешно изменен!',
                        })
                      }
                    });*/
                Swal.fire({
                  icon: 'success',
                  title: 'Успех',
                  text: 'Пароль был успешно изменен!',
                })

                router.replace('changePass')
                }
              }


            else {
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка!',
                text: 'Проверьте правильность ввода текущего пароля!',
              })
            }
          });
    },
  }
}
</script>

<style>
.cool-form{
  text-align: center;
  width: fit-content !important;
  max-width: max-content;
  margin: 10% auto auto;
  background-color: white;
  border-radius: 20px;
  padding: 0px 20px 20px 20px;
}
.input-cool{
  height: 20px;
  border-radius: 5px;
  width: 100%;
}
.cool-button{
  display: inline;
  background-color: #ccffd3;
  border-radius: 8px;
  border: 1px black solid;
  font-size: 16px;
}
</style>
