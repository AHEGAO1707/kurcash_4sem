<template>
  <div class="main_container">
    <div class="controls-holder">

      <div><h3 style="display: inline">Добавить карточку с заданием</h3> <img style=" cursor: pointer; display: inline"
                                                                              @click="add_task" id="add_task" width="30"
                                                                              src="../assets/add.png"></div>
      <div><h3 style="display: inline">Сохранить изменения </h3> <img style=" cursor: pointer; display: inline"
                                                                      @click="confirm_updates" id="conf_upd" width="30"
                                                                      src="../assets/confirm.png"></div>
    </div>
    <div class="container_grid">
      <div class="column">
        <h1>Планируется</h1>
        <draggable
            group="tasks_list"
            class="vList__draggable-item"
            v-model="tasks1"
        >
          <div
              v-for="(task, i) in tasks1"
              :key="i"
              :id=task.task_id
              class="task"
          >
            <h2 class="task-desc">{{ task.title }}</h2>
            <p class="task-desc">{{ task.description }}</p>
            <img style=" cursor: pointer; display: inline" @click="delete_task(task)" width="30"
                 src="../assets/delete.png">
          </div>
        </draggable>
      </div>
      <div class="column">
        <h1>В процессе</h1>
        <draggable
            group="tasks_list"
            class="vList__draggable-item"
            v-model="tasks2"
        >
          <div
              v-for="(task, i) in tasks2"
              :key="i"
              :id=task.task_id
              class="task"
          >
            <h2 class="task-desc">{{ task.title }}</h2>
            <p class="task-desc">{{ task.description }}</p>
            <img style=" cursor: pointer; display: inline" @click="delete_task(task)" width="30"
                 src="../assets/delete.png">
          </div>
        </draggable>
      </div>
      <div class="column">
        <h1>Выполнено</h1>
        <draggable
            group="tasks_list"
            class="vList__draggable-item"
            v-model="tasks3"
        >
          <div
              v-for="(task, i) in tasks3"
              :key="i"
              :id=task.task_id
              class="task"
          >
            <h2 class="task-desc">{{ task.title }}</h2>
            <p class="task-desc">{{ task.description }}</p>
            <img style=" cursor: pointer; display: inline" @click="delete_task(task)" width="30"
                 src="../assets/delete.png">
          </div>
        </draggable>
      </div>
    </div>
    <div style="display: flex; justify-content: center">
      <h1>Нравится сайт? Не поленитесь
        <router-link id="feedback" style="display: inline" to="/addFeedback">написать отзыв</router-link>! Спасибо!
      </h1>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';
import draggable from "vuedraggable";
import router from "../router/router";

export default {
  components: {draggable},
  data() {
    return {
      id: "",
      tasks1: [],
      tasks2: [],
      tasks3: []
    }
  },
  methods: {
    getPlanTasks() {
      let this_Comp = this;
      let id = this_Comp.$store.getters.GET_ID;
      let params = {id: `${id}`};
      axios
          .get("http://localhost/getPlanTasks.php", {params})
          .then(function (response) {
            if (response.data.result) {

              this_Comp.tasks1 = response.data.data;

            } else {
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка!',
                text: 'Произошла ошибка считывания данных для столбца "Планируется"',
              })
            }
          });
    },
    getInProcessTasks() {
      let this_Comp = this;
      let id = this_Comp.$store.getters.GET_ID;
      let params = {id: `${id}`};
      axios
          .get("http://localhost/getInProcessTasks.php", {params})
          .then(function (response) {
            if (response.data.result) {

              this_Comp.tasks2 = response.data.data;

            } else {
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка!',
                text: 'Произошла ошибка считывания данных для столбца "В процессе"',
              })
            }
          });
    },
    getReadyTasks() {
      let this_Comp = this;
      let id = this_Comp.$store.getters.GET_ID;
      let params = {id: `${id}`};
      axios
          .get("http://localhost/getReadyTasks.php", {params})
          .then(function (response) {
            if (response.data.result) {

              this_Comp.tasks3 = response.data.data;

            } else {
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка!',
                text: 'Произошла ошибка считывания данных для столбца "Выполнено"',
              })
            }
          });
    },
    confirm_updates() {

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
      })

      swalWithBootstrapButtons.fire({
        title: 'Вы уверены, что хотите сохранить изменения?',
        text: "Проверьте, что Вы расставили карточки по нужным Вам столбцам!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Да, сохранить!',
        cancelButtonText: 'Нет, не надо!',
        confirmButtonColor: '#00FF00',
        cancelButtonColor: '#FF0000',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.tasks1.forEach(task => {
            let id = task.task_id;
            let params = {id: id};
            axios
                .get("http://localhost/updatePlanTasks.php", {params})
          });
          this.tasks2.forEach(task => {
            let id = task.task_id;
            let params = {id: id};
            axios
                .get("http://localhost/updateInProcessTasks.php", {params})
          });
          this.tasks3.forEach(task => {
            let id = task.task_id;
            let params = {id: id};
            axios
                .get("http://localhost/updateReadyTasks.php", {params})
          })
          swalWithBootstrapButtons.fire(
              'Успешно!',
              'Позиции карточек были зафиксированы!',
              'success'
          )
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
              'Отмена',
              'Позиции карточек зафиксированы не были!',
              'error'
          )
        }
      })
    },
    delete_task(task) {

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
      })

      swalWithBootstrapButtons.fire({
        title: 'Вы уверены что хотите удалить эту карточку?',
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
          let id = task.task_id;
          var p_task = document.getElementById(`${id}`);
          p_task.style.display = 'none';
          let params = {id: id};
          axios
              .get("http://localhost/deleteTask.php", {params})
          swalWithBootstrapButtons.fire(
              'Успех!',
              'Карточка удалена успешно!',
              'success'
          )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
              'Отмена',
              'Всё в порядке. Карточка не была удалена!',
              'error'
          )
        }
      })
    },
    add_task() {
      router.replace('addTask')
    }
  },
  mounted() {
    this.getPlanTasks();
    this.getInProcessTasks();
    this.getReadyTasks();
  },
};
</script>

<style>
.main_container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  border-radius: 10px;
}

h2 {
  border-bottom: 1px black solid;
}

.container_grid {
  max-width: 100%;
  padding: 50px;
  padding-top: 1.5%;
  margin-bottom: 50px;
  justify-content: space-between;
  display: grid;
  grid-template-columns: repeat(auto-fit, 320px);
  gap: 2%;
  grid-row-end: auto;
  border-radius: 10px;
}

.column {
  display: flex;
  flex-direction: column;
  justify-content: start;
  gap: 30px;
  text-align: center;
  padding: 20px;
  min-height: 500px;
  border: 1px solid black;
  border-radius: 10px;
  background-color: white;
}

.task {
  display: flex;
  text-align: left;
  flex-direction: column;
  justify-content: space-between;
  width: 280px;
  border: 1px solid black;
  align-items: start;
  align-self: center;
  padding: 10px;
  border-radius: 10px;
}

.task:hover {
  background: forestgreen;
  color: white;
  cursor: pointer;
}

.vList__draggable-item {
  display: flex;
  flex-direction: column;
  gap: 20px;
  min-height: 500px;
}

.controls-holder {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: flex-end;
  width: 92%;
  margin: auto;
  height: 50px;
}

.task-desc {
  width: 95%;
  word-break: break-word;
}
</style>