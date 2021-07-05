<template>
  <div>
    <form v-on:submit.prevent="onSubmit" class="cool-form" >
      <h1>Добавление отзыва</h1>
      <div>
        <p><label>Оцените наш сайт от 1 до 5</label></p>
        <input type="number" min="1" max="5" class="input-cool" id="inpType" required v-model="feedback_type_id" placeholder="Оценка сайта"/>
      </div>
      <div>
        <p><label>Добавьте отзыв</label></p>
        <input class="input-cool" id="inpDescription" v-model="description" placeholder="Отзыв о сайте"/>
      </div>
      <hr/>
      <div>
        <button class="cool-button" type="button" id="butBack" @click="goToHome">Назад</button> |
        <button class="cool-button" type="button" id="butAddFeedback" @click="add_feedback">Добавить отзыв</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import router from '../router/router'
import Swal from "sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';


export default {
  data() {
    return {
      feedback_type_id: "",
      description: "",
      feedback_owner_id: "",
    }
  },

  methods: {

    add_feedback: function () {
      let feedback_type_id = document.getElementById("inpType").value;
      let description = document.getElementById("inpDescription").value;
      if (feedback_type_id !== "" && description !== "" && feedback_type_id >= "1" && feedback_type_id <= "5") {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
          title: 'Вы уверены что хотите добавить отзыв?',
          text: "После добавления отзыва Вы не сможете его отредактировать!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Да, добавить!',
          cancelButtonText: 'Нет, не добавлять!',
          confirmButtonColor: '#00FF00',
          cancelButtonColor: '#FF0000',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            let this_Comp = this;
            let id = this_Comp.$store.getters.GET_ID
            let params = {feedback_type_id: `${feedback_type_id}`, description: `${description}`, id: `${id}`};
            axios
                .get("http://localhost/addFeedback.php", {params})

            swalWithBootstrapButtons.fire(
                'Отзыв был добавлен! Спасибо большое!',
                'Вы будете перенаправлены в раздел «Таск-трекер»',
                'success'
            )
            router.replace('home')
          } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
                'Действие отменено!',
                'Вы можете вернуться в раздел «Таск-трекер» через верхнюю навигационную панель или нажав на кнопку «Назад»',
                'error'
            )
          }
        })
      }
      else {
        Swal.fire({
          icon: 'error',
          title: 'Пожалуйста...',
          text: 'Заполните все поля и проверьте правильность заполнения поля оценки сайта!',
        })
      }
    },

    goToHome: function () {
      router.replace('home')
    },

    getFeedbackOrNot: function () {
      let this_Comp = this;
      let id = this_Comp.$store.getters.GET_ID
      let params = {id: `${id}`};
      axios
          .get("http://localhost/getFeedbackOrNot.php", {params})

          .then(function (response) {
            if (response.data.result === false) {
              Swal.fire({
                icon: 'info',
                title: 'Извините!',
                text: 'Вы уже написали отзыв о нашем сайте. Вы перенаправлены в раздел "Таск-трекер"',
              })
              router.replace('home');
            }
          })
    }
  },

  mounted() {
    this.getFeedbackOrNot();
  },
}
</script>