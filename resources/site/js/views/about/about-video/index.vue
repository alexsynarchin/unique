<template>
    <figure class="about-video" v-bind:style="{backgroundImage:'url(\'' + url +'\')'}" :class="{'about-video--video-start': videoStart}">
        <svg viewBox="0 0 48 56" class="about-video__btn"  @click="openVideo" v-if="!videoStart">
            <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-play"></use>
        </svg>
        <iframe
                v-if="videoStart"
                width="100%"
                style="height:515px"
                :src="video_url">
        </iframe>
    </figure>
</template>
<script>
    export default {
        props: {
            video_id: {
                type:String
            }
        },
        data() {
            return {
                videoStart:false,
                url: 'https://img.youtube.com/vi/'+ this.video_id + '/hqdefault.jpg',
                video_url:"",
            }
        },
        methods: {
            openVideo() {
                this.videoStart = true;
                this.video_url = 'https://www.youtube.com/embed/' + this.video_id + '?autoplay=1'
            },
        }
    }
</script>
