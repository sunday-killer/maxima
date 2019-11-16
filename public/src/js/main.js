Vue.use(window.vuelidate.default)
const { required, numeric, maxLength } = window.validators

new Vue({
  el: '#app',
  data: {
    name: '',
    price: 0,
    description: '',
    details: '',
    isLoading: false
  },
  validations: {
    name: { required },
    price: { required, numeric },
    description: { required },
    details: { required },
  },
  methods: {
    createProduct () {

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

      $.ajax({
        url: PATH + 'ajax/createProduct.php',
        type: 'POST',
        dataType: 'JSON',
        data: (formData),
        success: data => {
          console.log(data)
        },
        error (err) {
          console.error(err)
        }
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
    }
  }
})