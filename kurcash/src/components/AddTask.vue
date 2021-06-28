<template>
  <div>
    <form v-on:submit.prevent="onSubmit" class="cool-form" >
      <h1>Добавление карточки с заданием</h1>
      <div>
        <p><label>Придумайте заголовок для карточки </label></p>
        <input class="input-cool" id="inpTitle" v-model="title" placeholder="Заголовок для карточки"/>
      </div>
      <div>
        <p><label>Добавьте описание карточки </label></p>
        <input class="input-cool" id="inpDescription" v-model="description" placeholder="Описание карточки"/>
      </div>
      <hr/>
      <div>
        <button class="cool-button" type="button" id="butBack" @click="goToHome">Назад</button> |
        <button class="cool-button" type="button" id="butAddTask" @click="add_task">Добавить карточку</button>
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
      title: "",
      description: "",
    }
  },

  methods: {

    add_task: function () {
      let title = document.getElementById("inpTitle").value;
      let description = document.getElementById("inpDescription").value;
      if (title !== "" && description !== "") {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
          title: 'Вы уверены что хотите добавить эту карточку?',
          text: "Карточка будет добавлена в колонку «Планируется»",
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
            let params = {title: `${title}`, description: `${description}`, id: `${id}`};
            axios
                .get("http://localhost/addTask.php", {params})

            swalWithBootstrapButtons.fire(
                'Карточка была добавлена!',
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
          text: 'Заполните все поля!',
        })
      }
    },

    goToHome: function () {
      router.replace('home')
    }
  }
}
</script>