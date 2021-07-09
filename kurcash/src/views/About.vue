<template>
  <div class="about">
    <p class="text">В настоящее время, в процессе разработки проектов, многие люди испытываю острую необходимость в эфективном тайм-менеджменте. <br>
    Наш сайт таск-трекер поможет Вам в этом!<br>
      Удобная авторизация в пару кликов; быстрая регистриция на сайте, не требующая от Вас ненужной информации;
      функция добавления карточки с заданием, а также её удалением! <br>
      И это ещё не всё! Также наш таск-трекер выполнен по методологии Канбан-доски, а это значит что Вы не запутаетесь в огромной количестве колонок со статусами
      задач: у Вас будут только 3, самые необходимые для оптимального тайм-менеджмента, колонки, а именно "Планируется", "В процессе" и "Выполнено"! <br>
    </p>
    <p class="text">
      Сомневаетесь в выборе нашего продукта?! Тогда посмотрите видео-демонстрацию работы нашего таск-трекера!
    </p>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/qtLwwaqvm1c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    <p class="text">
      Если Вы до сих пор в сомнениях, другие пользователи помогут Вам наконец определиться с правильным выбором! Представляем Вашему вниманию отзывы посетителей!
    </p>

    <div class="container_grid_feedbacks">
      <div
          v-for="(feedback, i) in feedbacks"
          :key="i"
          class="feedback"
      >
        <h2>{{ feedback.description}}</h2>
        <p>Оценка сайта: {{ feedback.feedback_type_id}}</p>
      </div>
    </div>

  </div>
</template>


<script>
import axios from "axios";

export default {
  data() {
    return {
      feedbacks: [],
    }
  },
  methods: {
    getFeedbacks() {
      let this_Comp = this;
      axios
          .get("http://localhost/getFeedbacks.php")
          .then(function (response) {
              this_Comp.feedbacks = response.data.data;
          });
    },
  },

  mounted: function () {
    this.getFeedbacks();
  },
};
</script>


<style>
.about {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.container_grid_feedbacks {
  max-width: 100%;
  padding: 40px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.feedback {
  text-align: left;
  margin: 10px;
  background-color: white;
  border: 1px solid black;
  padding: 10px;
  border-radius: 10px;
}

.text {
  font-size: 26px;
  color: black;
  text-align: center;
}
</style>

