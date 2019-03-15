<template>
    <div class="like-wrapper">
        <span @click="likeStatus($event)">
            <i class="far fa-thumbs-up app-like-button"></i>
        </span>
    </div>
</template>

<script>
    export default {
        name: 'Like',
        props: {
            path: {
                type: String,
                required: true
            },
            statusId: {
                type: String,
                required: true
            }
        },
        methods: {
            likeStatus (event) {
                axios.get(this.path)
                     .then(response => {
                         if (response.data.likesCount) {
                            let likesCountFromRef = 'likesCount' + this.statusId;
                            let likesCountSpan = this.$parent.$refs[likesCountFromRef];
                            likesCountSpan.innerText = response.data.likesCount;
                         }

                         if (response.data.liked) {
                            let likesCountFromRef = 'likesCount' + this.statusId;
                            let likesCountSpan = this.$parent.$refs[likesCountFromRef];

                            let small = document.createElement('small');
                            let nameForClass = 'small' + this.statusId;

                            small.className = nameForClass;
                            small.innerText = 'You have already liked';
                            
                            Object.assign(small.style, {
                                marginLeft: '5px', 
                                color: '#d00',
                            });

                            let parent = likesCountSpan.parentNode;
                            if (!document.querySelector('.' + nameForClass)) {
                                parent.append(small);
                            }
                            
                            setTimeout(() => {
                                Object.assign(small.style, {
                                    marginLeft: '-5000px', 
                                    opacity: 0,
                                    transition: 'all 2s linear'
                                });
                            }, 6000);

                            setTimeout(() => {
                                small.remove();
                            }, 7000)
                         }
                     })
            }
        }
    }
</script>

<style lang="scss" scoped>

    div.like-wrapper {
        display: inline-block;

        span {
            color: #18BC9C;
            cursor: pointer;

            &:focus,
            &:hover {
                color: #0f7864;
            }
        }
    }

    .app-like-button {
        font-size: 1.2rem;
        position: relative;
        top: 2px;
    }

</style>