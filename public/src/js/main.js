Vue.use(window.vuelidate.default)
const { required, numeric, maxLength } = window.validators

new Vue({
  el: '#app',
  data: {
    name: '',
    price: 0,
    description: '',
    details: '',
    productsList: {},
    error: null,
    isLoading: false,
    editableProductId: null
  },
  validations: {
    name: { required },
    price: { required, numeric },
    description: { required },
    details: { required },
  },
  methods: {
    saveProduct () {

      if (!this.isInvalid()) {
        this.$v.$touch();
        return;
      }

      let formData = {
        name: this.name,
        price: +this.price,
        description: this.description,
        details: this.details
      }

      this.isLoading = true;

      if (this.editableProductId === null) {
        $.ajax({
          url: PATH + 'ajax/createProduct.php',
          type: 'POST',
          dataType: 'JSON',
          data: (formData),
          success: data => {
            console.log(data)
            this.isLoading = false;
            Vue.set(this.productsList, data, {
              name: this.name,
              price: +this.price,
              description: this.description,
              details: this.details
            });
            this.clearForm();
          },
          error (err) {
            console.error(err)
            this.error = err;
          }
        });
      } else {
        formData["id"] = this.editableProductId;
        $.ajax({
          url: PATH + 'ajax/updateProduct.php',
          type: 'POST',
          dataType: 'JSON',
          data: (formData),
          success: data => {
            console.log(data)
            Vue.set(this.productsList, this.editableProductId, {
              name: this.name,
              price: +this.price,
              description: this.description,
              details: this.details
            });
            this.clearForm();
            this.isLoading = false;
          },
          error (err) {
            console.error(err)
            this.error = err;
            this.clearForm();
            this.editableProductId = null;
          }
        });
      }
    },
    getProductList () {
      this.isLoading = true;
      $.ajax({
        url: PATH + 'ajax/getProductsList.php',
        type: 'POST',
        dataType: 'JSON',
        success: data => {
          this.productsList = data;
          this.isLoading = false;
        },
        error (err) {
          console.error(err)
          this.error = err;
        }
      });
    },
    deleteProduct(id) {
      Swal.fire({
        title: 'Вы уверены, что хотите удалить?',
        text: "Это действие нельзя будет отменить!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Да, удаляем!',
        cancelButtonText: 'Пожалуй не надо!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: PATH + 'ajax/deleteProduct.php',
            type: 'POST',
            dataType: 'JSON',
            data: ({id}),
            success: data => {
              console.log(data);
              Vue.delete(this.productsList, id);
              Swal.fire(
                'Удалено!',
                '',
                'success'
              )
            },
            error (err) {
              console.error(err)
              this.error = err;
            }
          });
        }
      })
    },
    updateProduct(id) {
      this.editableProductId = id;
      this.name = this.productsList[id]["name"];
      this.price = this.productsList[id]["price"];
      this.description = this.productsList[id]["description"];
      this.details = this.productsList[id]["details"];

      setTimeout(() => {
        M.updateTextFields();
        M.textareaAutoResize(this.$refs.description);
        M.textareaAutoResize(this.$refs.details);
      }, 0)
    },
    clearForm () {
      this.name = '';
      this.price = 0;
      this.description = '';
      this.details = '';
      this.editableProductId = null;
      this.$v.$reset();
      setTimeout(() => {
        M.textareaAutoResize(this.$refs.description);
        M.textareaAutoResize(this.$refs.details);
      });
    },
    status(validation) {
      return {
        error: validation.$error,
        dirty: validation.$dirty
      }
    },
    isInvalid () {
      return !this.$v.name.$error || !this.$v.price.$error || !this.$v.description.$error || !this.$v.details.$error
    },
  },
  mounted() {
    this.getProductList();
  }
})