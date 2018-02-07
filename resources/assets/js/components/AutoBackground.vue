<template>
    <div class="bg" :class="{'is-active' : f_image, 'is-second' : secondImage}">
        <div id="fluid-bg" v-bind:style="{ 'background-image': 'url(' + f_image + ')' }"></div>
        <div id="fluid-bg-2" v-bind:style="{ 'background-image': 'url(' + s_image + ')' }"></div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                secondImage: false,
                url: null,
                number: 0,
                f_image: '',
                s_image: ''
            }
        },
        mounted: function () {
            let that = this;

            let elem = document.getElementById('fluid-bg');

            that.url = "https://picsum.photos/" + (Math.random() > 0.5 ? 'g/' : '') + elem.offsetWidth +"/" + elem.offsetHeight + "?random";

            that.changeIcon(that);
        },
        methods: {
            changeIcon: function (that) {
                let image = new Image();

                let used_url = that.url + '&' + that.number;
                that.number++;

                image.onload = function(){

                    image.onload = null;

                    if (!that.secondImage) {
                        that.s_image = used_url;

                        setTimeout(function() {
                            that.secondImage = true;
                        }, 2000);
                    } else {
                        that.f_image = used_url;

                        setTimeout(function() {
                            that.secondImage = false;
                        }, 2000);
                    }

                    setTimeout(function() {
                        that.changeIcon(that);
                    }, 8000);
                };

                image.src = used_url;
            }
        }
    }
</script>
