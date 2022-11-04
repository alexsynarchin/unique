<template>
    <div class="modal fade unique-modal video-modal" id="video_modal"  tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog video-modal__dialog" role="document">
            <div class="unique-modal__content modal-content video-modal__content">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <iframe width="100%" height="auto" :src="url" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
        </div>
    </div>
    </div>
</template>
<script>

export default {
    props: {
        link: {
            type:String,
            default: "https://www.youtube.com/embed/MheHw-rbMMg"
        }
    },
    components: {

    },
    data() {
        return {
            url: "",
        }
    },
    methods: {

    },
    mounted() {
        var myModalEl = document.getElementById('video_modal');
        let vm = this;
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            vm.url = "";
        });
        myModalEl.addEventListener('show.bs.modal', function (event) {
            vm.url = vm.link;
        });
    }
}
</script>
