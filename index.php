<?php
require_once 'config/init.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Главная</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="public/dist/css/materialize.min.css">
  <link rel="stylesheet" href="public/dist/css/sweetalert2.min.css">
  <link rel="stylesheet" href="public/dist/css/all.css">
</head>
<body>

<nav>
  <div class="nav-wrapper">
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a>Главная</a></li>
    </ul>
  </div>
</nav>

<main class="container" id="app">
  <form class="form" @submit.prevent="saveProduct">
    <div class="row">

      <div class="input-field col s6">
        <input
          placeholder="Наименование товара"
          id="name"
          type="text"
          class="validate"
          v-model="$v.name.$model"
          :class="status($v.name)"
        />
        <label for="name">Наименование товара</label>
        <small class="helper-text invalid" v-if="!$v.name.required && $v.name.$dirty">Поле "Наименование товара" обязательно для заполнения</small>
      </div>

      <div class="input-field col s6">
        <input
          placeholder="Цена"
          id="price"
          type="text"
          class="validate"
          v-model="$v.price.$model"
          :class="status($v.price)"
        />
        <label for="price">Цена</label>
        <small class="helper-text invalid" v-if="!$v.price.required && $v.price.$dirty">Поле "Цена" обязательна для заполнения</small>
        <small class="helper-text invalid" v-else-if="!$v.price.numeric && $v.price.$dirty">Только цифры</small>
      </div>

      <div class="input-field col s12">
        <textarea
            id="description"
            ref="description"
            class="materialize-textarea validate"
            v-model="$v.description.$model"
            :class="status($v.description)"
        ></textarea>
        <label for="description">Описание</label>
        <small class="helper-text invalid" v-if="!$v.description.required && $v.description.$dirty">Поле "Описание" обязательна для заполнения</small>
      </div>

      <div class="input-field col s12">
        <textarea
            id="details"
            ref="details"
            class="materialize-textarea validate"
            v-model="$v.details.$model"
            :class="status($v.details)"
        ></textarea>
        <label for="details">Характеристики товара</label>
        <small class="helper-text invalid" v-if="!$v.details.required && $v.details.$dirty">Поле "Характеристики товара" обязательна для заполнения</small>
      </div>

    </div>

    <div class="row">
      <button
        type="submit"
        name="send_form"
        class="waves-effect waves-light btn"
        :disabled="$v.name.$error || $v.price.$error || $v.description.$error || $v.details.$error"
      >Сохранить</button>

      <button
        type="button"
        name="send_form"
        class="waves-effect waves-light btn"
        @click="clearForm"
      >Очистить форму</button>

    </div>
  </form>

  <table class="highlight">
    <thead>
      <tr class="red lighten-2">
        <th>Наименование</th>
        <th>Цена</th>
        <th>Описание</th>
        <th>Характеристики</th>
        <th>Редактирование</th>
      </tr>
    </thead>
    <tbody>
      <tr
          v-for="(product, id) in productsList"
          :key="id"
      >
        <td>{{product.name}}</td>
        <td>{{product.price}}</td>
        <td>{{product.description}}</td>
        <td>{{product.details}}</td>
        <td>
          <button
              type="button"
              class="waves-effect waves-light btn-small blue lighten-2"
              @click="updateProduct(id)"
          >
            <i class="material-icons small">create</i>
          </button>
          <button
              type="button"
              class="waves-effect waves-light btn-small red lighten-2"
              @click="deleteProduct(id)"
          >
            <i class="material-icons small">delete_forever</i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>

</main>


<script>
  let PATH = '<?= PATH ?>';
</script>

<script src="public/dist/js/materialize.min.js"></script>
<script src="public/dist/js/vue.min.js"></script>
<script src="public/dist/js/vuelidate.min.js"></script>
<script src="public/dist/js/validators.min.js"></script>
<script src="public/dist/js/jquery.min.js"></script>
<script src="public/dist/js/sweetalert2.min.js"></script>
<script src="public/dist/js/main.js"></script>

</body>
</html>