<script>
    export default {
        data: function () {
            return {
                errorsTable: false,
                login: '',
                email: '',
                password: '',
                bussy: false
            }
        },
        methods: {
            submit: function (e) {
                e.preventDefault();
                let form = new FormData();
                let that = this;

                that.bussy = true;

                if (this.login) {
                    form.append('login', this.login);
                }

                if (this.email) {
                    form.append('email', this.email);
                }

                if (this.password) {
                    form.append('password', this.password);
                }

                if (this.password_confirmation) {
                    form.append('password_confirmation', this.password_confirmation);
                }

                axios.post(this.$el.getAttribute('action'), form).then(
                    function (response) {
                        that.bussy = false;

                        if (response.status === 200) {
                            window.location = response.data.redirect;
                        } else {
                            that.errorsTable = true;
                        }
                    }.bind(this)
                ).catch(function () {
                    that.bussy = false;
                    that.errorsTable = true;
                });
            }
        }
    }
</script>
