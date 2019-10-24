<template>
    <div>
        <b-carousel
            id="carousel-1"
            v-model="slide"
            :interval="4000"
            controls
            indicators
            background="#ababab"
            img-width="1024"
            img-height="400"
            style="text-shadow: 1px 1px 2px #333;"
            @sliding-start="onSlideStart"
            @sliding-end="onSlideEnd"
        >
            <b-carousel-slide>
                <template v-slot:img>
                    <picture>
                        <source type="image/webp" srcset="/images/memorial-garden-7.webp">
                        <source type="image/jpeg" srcset="/images/memorial-garden-7.jpg">
                        <img
                            class="d-block img-fluid w-100"
                            width="1024"
                            height="300"
                            src="/images/memorial-garden-7.jpg"
                            alt="Memorial Garden"
                        >
                    </picture>
                </template>
            </b-carousel-slide>
            <b-carousel-slide>
                <template v-slot:img>
                    <picture>
                        <source type="image/webp" srcset="/images/memorial-garden-8.webp">
                        <source type="image/jpeg" srcset="/images/memorial-garden-8.jpg">
                        <img
                            class="d-block img-fluid w-100"
                            width="1024"
                            height="300"
                            src="/images/memorial-garden-8.jpg"
                            alt="Memorial Garden"
                        >
                    </picture>
                </template>
            </b-carousel-slide>
            <b-carousel-slide>
                <template v-slot:img>
                    <picture>
                        <source type="image/webp" srcset="/images/memorial-garden-9.webp">
                        <source type="image/jpeg" srcset="/images/memorial-garden-9.jpg">
                        <img
                            class="d-block img-fluid w-100"
                            width="1024"
                            height="300"
                            src="/images/memorial-garden-9.jpg"
                            alt="Memorial Garden"
                        >
                    </picture>
                </template>
            </b-carousel-slide>
            <b-carousel-slide>
                <template v-slot:img>
                    <picture>
                        <source type="image/webp" srcset="/images/memorial-garden-11.webp">
                        <source type="image/jpeg" srcset="/images/memorial-garden-11.jpg">
                        <img
                            class="d-block img-fluid w-100"
                            width="1024"
                            height="300"
                            src="/images/memorial-garden-11.jpg"
                            alt="Memorial Garden"
                        >
                    </picture>
                </template>
            </b-carousel-slide>
            <b-carousel-slide>
                <template v-slot:img>
                    <picture>
                        <source type="image/webp" srcset="/images/memorial-garden-12.webp">
                        <source type="image/jpeg" srcset="/images/memorial-garden-12.jpg">
                        <img
                            class="d-block img-fluid w-100"
                            width="1024"
                            height="300"
                            src="/images/memorial-garden-12.jpg"
                            alt="Memorial Garden"
                        >
                    </picture>
                </template>
            </b-carousel-slide>
        </b-carousel>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                slide: 0,
                sliding: null,
            }
        },
        methods: {
            onSlideStart(slide) {
                this.sliding = true
            },
            onSlideEnd(slide) {
                this.sliding = false
            }
        }
    }
</script>