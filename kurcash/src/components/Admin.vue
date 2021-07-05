<template>
  <div class="admin_container">
    <h1 style="position: center">Всего пользователей зарегистрировано на сайте: {{total_users}}</h1>
    <h1 style="position: center">Всего карточек c заданиями присутствует в базе данных: {{total_current_tasks}}</h1>
    <input style="padding: 10px; border-radius: 10px; width: 30%;" placeholder="Поиск по почте..." v-model="search">
    <h1 style="position: center">Список зарегистрированных пользователей:</h1>
    <div class="container_grid_admin">
      <div
          v-for="(user, i) in filtered_users"
          :key="i"
          :id=user.user_id
          class="user"
      >
        <h2>{{ user.name + " " + user.surname }}</h2>
        <p>{{ user.email }}</p>
        <img style=" cursor: pointer; display: inline" @click="delete_user(user)" width="30" src="../assets/delete.png">
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";
import Swal from "sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';

export default {
  data() {
    return {
      id: "",
      users: [],
      search: "",
      total_users: "",
      total_current_tasks: ""
    }
  },
  methods: {
    getUsers() {
      let this_Comp = this;
      axios
          .get("http://localhost/getUsers.php")
          .then(function (response) {
            if (response.data.result) {

              this_Comp.users = response.data.data;

            } else {
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка!',
                text: 'Произошла ошибка получения списка пользователей!',
              })
            }
          });
    },
    getTotal_users() {
      let this_Comp = this;
      axios
          .get("http://localhost/getTotal_users.php")
          .then(function (response) {

            this_Comp.total_users = response.data.data;

          })
    },
    getTotal_current_tasks() {
      let this_Comp = this;
      axios
          .get("http://localhost/getTotal_current_tasks.php")
          .then(function (response) {

            this_Comp.total_current_tasks = response.data.data;

          })
    },

    delete_user(user) {

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
      })

      swalWithBootstrapButtons.fire({
        title: 'Вы уверены что хотите удалить этого пользователя?',
        text: "Вы не сможете отменить это действие!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Да, удалить!',
        cancelButtonText: 'Нет, стоп, отмена!',
        confirmButtonColor: '#00FF00',
        cancelButtonColor: '#FF0000',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          let id = user.user_id;
          var p_user = document.getElementById(`${id}`);
          p_user.style.display = 'none';
          let params = {id: id};
          axios
              .get("http://localhost/deleteUser.php", {params})
          swalWithBootstrapButtons.fire(
              'Успех!',
              'Пользователь, а также все его карточки с заданиями были удалены успешно!',
              'success'
          )
          this.getTotal_users();
          this.getTotal_current_tasks();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
              'Отмена',
              'Всё в порядке. Пользователь не был удален!',
              'error'
          )
        }
      })
    }
  },
  computed: {
    filtered_users: function () {
      var keyword = this.search.toLowerCase();
      return this.users.filter(
          (x) =>
              x.email.toLowerCase().includes(keyword)
      );
    },
  },


  created() {
    this.getUsers();
    this.getTotal_users();
    this.getTotal_current_tasks();
  },
};
</script>


<style>
.admin_container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  border-radius: 10px;
}

h2 {
  border-bottom: 1px black solid;
}

.container_grid_admin {
  max-width: 100%;
  padding: 50px;
  margin-bottom: 50px;
  display: grid;
  grid-template-columns: repeat(auto-fill, 320px);
  gap: 2%;
  grid-row-end: auto;
  border-radius: 10px;
}

.user {
  display: flex;
  text-align: left;
  flex-direction: column;
  justify-content: space-between;
  background-color: white;
  width: 280px;
  border: 1px solid black;
  align-items: start;
  align-self: center;
  padding: 10px;
  border-radius: 10px;
}

</style>

