<template>
    <div>
        <div class="d-flex justify-content-between align-items-center">

            <h5 class="gallery-h5" 
                v-text="imagesCountFromDB ? userName + '`s Gallery' : 'Gallery is empty'"
            ></h5>

            <a class="btn btn-outline-primary float-right" 
               v-show="authUserId === userId" 
               data-toggle="collapse" 
               href="#collapseExample" 
               role="button" 
               aria-expanded="false" 
               aria-controls="collapseExample"
            >
                Toggle for upload
            </a>

        </div>

        <div class="collapse mt-3" id="collapseExample">

            <div class="uploader"
                @dragenter="onDragEnter"
                @dragleave="onDragLeave"
                @dragover.prevent
                @drop="onDrop"
                :class="{ dragging: isDragging}"
            >

                <form class="upload-control" v-show="images.length" @submit.prevent="upload">
                    <label for="file">Select a file</label>
                    <button type="submit">Upload</button>
                </form>

                <div v-show="!images.length">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Drag your images here</p>
                    <div>OR</div>
                    <form class="file-input">
                        <label for="file">Select a file</label>
                        <input type="file" id="file" @change="onInputChange" multiple>
                    </form>
                </div>

                <div class="images-preview" v-show="images.length">
                    <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                        <img :src="image" :alt="'Image uploader ' + index" class="img-responsive">
                        <div class="details">
                            <span class="name" v-text="files[index].name"></span>
                            <span class="size" v-text="getFileSize(files[index].size)"></span>
                        </div>
                        <span class="delete-from-preview" @click.stop="deleteFromPreview($event, index)">&times;</span>
                    </div>
                </div>

            </div>

        </div>

        <div class="user-gallery mt-4" v-show="gallery.length">
            <div class="gallery-image-wrap hover-zoomin" v-for="(item, index) in gallery" :key="index">
                <a data-fancybox="gallery" :href="storagePath + '/' + item.image">
                    <img :src="storagePath + '/' + item.image">
                </a>
                <button class="btn btn-outline-danger delete-from-gallery" @click.stop="deleteFromGallery($event, item.id)">&times;</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'GalleryComponent',
        props: {
            url: {
                type: String,
                required: true
            },
            userId: {
                type: String,
                required: true
            },
            userName: {
                type: String,
                required: true
            },
            authUserId: {
                type: String,
                required: true
            },
            storagePath: {
                type: String,
                required: true
            }
        },
        data: () => ({
            isDragging: false,
            dragCount: 0,
            files: [], // for uploading files to a server
            images: [], // for presenting images to users
            gallery: [],
            imagesCountFromDB: 0
        }),
        methods: {
            onInputChange(e) {
                const files = e.target.files;
                Array.from(files).forEach(file => {
                    this.addImage(file)
                });

                // If you select an image, then remove it, without this you can not select the same image again
                e.target.value = '';
            },
            onDragEnter(e) {
                e.preventDefault();

                this.dragCount++;
                this.isDragging = true;
            },
            onDragLeave(e) {
                e.preventDefault();

                this.dragCount--;

                if (this.dragCount <= 0) {
                    this.isDragging = false;
                }
            },
            onDrop(e) {
                e.preventDefault();
                e.stopPropagation();

                this.isDragging = false;

                const files = e.dataTransfer.files;
                Array.from(files).forEach(file => {
                    this.addImage(file)
                });
            },
            addImage(file) {
                if (!file.type.match('image.*')) {
                    this.$toastr.e(`${file.name} is not a image`);
                    return;
                }

                if (file.name.length > 60) {
                    this.$toastr.e(`${file.name} name is too long`);
                    return;
                }

                this.files.push(file);

                const img = new Image(); 
                const reader = new FileReader(); 

                reader.onload = (e) => {
                    this.images.push(e.target.result);
                }
                reader.readAsDataURL(file);
            },
            upload() {
                const formData = new FormData();

                this.files.forEach(file => {
                    formData.append('images[]', file, file.name);
                    formData.append('id', this.userId);
                });

                axios.post(this.url + '/gallery/add', formData)
                     .then(response => {

                        if (response.data.gallery) {    

                            this.gallery = response.data.gallery;
                            this.imagesCountFromDB = response.data.gallery.length;

                            let fromServerDiv = this.$parent.$refs.fromServer;

                            if (fromServerDiv) {
                                fromServerDiv.remove();
                            }
                        }
                        
                         let message = '';
                         if (this.images.length == 1) {
                            message = 'The image successfully uploaded';
                         } else {
                            message = 'All images successfully uploaded';
                         }
                         this.$toastr.s(message);
                         this.files = [];
                         this.images = [];
                     })
            },
            getFileSize(size) {
                const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
                let i = 0;

                while(size > 900) {
                    size /= 1024;
                    i++;
                }

                return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
            },
            deleteFromPreview(event, index) {
                //let res = event.currentTarget.parentElement;
                let res = event.target.parentElement;
                res.style.opacity = '0';
  
                setTimeout(() => {
                    this.files.splice(index, 1);
                    this.images.splice(index, 1);

                    /* 
                        After deleting the element the value of the index and the opacity style will be passed 
                        to the next element. So to show the next element again opacity must be 1.
                    */
                    res.style.opacity = '1';
                }, 300);
            },
            deleteFromGallery(event, id) {
                event.target.parentNode.classList.add("hide-gallery-pic");
                
                setTimeout(() => {
                    event.target.parentNode.remove();
                }, 300);

                axios.post(this.url + '/gallery/delete', {id}).then(response => {
                    if (response.data.gallery) {
                        this.imagesCountFromDB = response.data.gallery.length;
                    }
                });
            }
        },
        mounted() {
            let userId = this.userId;
            axios.get(this.url + '/gallery/get/all/' + userId).then(response => {

                if (response.data.galleryCount) {
                    this.imagesCountFromDB = response.data.galleryCount;
                }
            });

            let deleteFromGallery = document.querySelectorAll(".delete-from-gallery");
            
            deleteFromGallery.forEach(btn => {
                btn.addEventListener("click", event => {
                    event.stopPropagation();
                    let userId = event.target.getAttribute("data-id");
                    this.deleteFromGallery(event, userId);                   
                });
            });
        }
    }
</script>

<style lang="scss">
    @import '~vue-toastr/src/vue-toastr.scss';

    .uploader {
        width: 100%;
        background-color: #2C3E50;
        padding: 10px;
        text-align: center;
        border-radius: 10px;
        border: 3px dashed #fff;
        color: #fff;
        font-size: 20px;
        position: relative;
        transition: all .3s linear;

        &.dragging {
            background-color: #fff;
            color: #2C3E50;
            border: 3px dashed #2C3E50;

            .file-input label {
                background-color: #2C3E50;
                color: #fff;
            }
        }

        i {
            font-size: 55px
        }

        .file-input {
            width: 200px;
            margin: auto;
            height: 70px;
            position: relative;

            label,
            input {
                background-color: #fff;
                color: #2C3E50;
                width: 100%;
                position: absolute;
                left: 0;
                top: 0;
                padding: 4px;
                border-radius: 4px;
                margin-top: 7px;
                cursor: pointer;
                transition: all .3s linear;

                &:hover {
                    background-color: #2C3E50;
                    color: #fff;
                }
            }

            input {
                opacity: 0;
                z-index: -10;
            }
        }
    }

    .images-preview {
        display: flex;
        flex-wrap: wrap;
        margin-top: 70px;
        justify-content: space-around;

        .img-wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin: 10px;
            min-height: 100px;
            justify-content: space-between;
            padding-top: 10px;
            background-color: #fff;
            box-shadow: 5px 5px 20px #3e3737;
            position: relative;
            opacity: 1;
            transition: all 300ms linear;

            img {
                max-height: 150px;
                object-fit: contain;
            }

            .details {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 3px 6px;
                font-size: 12px;
                background-color: #fff;
                color: #2C3E50;

                .name {
                    overflow: hidden;
                    height: 18px;
                }
            }

            .delete-from-preview {
                position: absolute;
                top: 0;
                right: 0;
                color: #d00;
                cursor: pointer;
                transition: transform .2s linear;
                padding: 0 10px;
                height: 40px;
                font-weight: bold;
                font-size: 25px;

                &:hover {
                    transform: rotate(180deg);
                }
            }
        }
    }

    .upload-control {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 10px;
        padding-bottom: 4px;
        text-align: right;
        margin-bottom: 10px;

        button, label {
            background-color: #2C3E50;
            border: 2px solid #2C3E50;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            padding: 5px;
            cursor: pointer;
            transition: all .3s linear;

            &:hover {
                background-color: #fff;
                border: 2px solid #fff;
                border-radius: 3px;
                color: #2C3E50;
            }
        }
    }

    @media only screen 
    and (min-width: 768px) {
        .img-wrapper {
            width: 30% !important;
        }
    }

    @media only screen 
    and (min-width: 450px)
    and (max-width: 768px){
        .img-wrapper {
            width: 45% !important;
        }
    }
</style>