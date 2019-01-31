<template>
    <div class="search-box mr-auto">
        <form class="top-search-form" @submit.prevent="">
            <input class="form-control top-search-input"
                    type="search"
                    placeholder="Type name and press enter to search"
                    name="search"
                    aria-label="Search"
                    autocomplete="off"
                    v-model="search"
                    @blur="onBlur"
                    @keyup="userSearch">
        </form>

        <transition name="search">
            <div class="search-results" v-if="users.length > 0">
                <ul class="list-unstyled">
                    <li 
                        v-for="(user, index) in users"
                        :key="index"
                    >
                        <img 
                            v-if="user.pic == 'boy.png' || user.pic == 'girl.png'"
                            :src="assets + '/profile-images/' + user.pic" 
                            class="search-user-img mr-2" 
                            :alt="user.name"
                        >
                        <img 
                            v-else
                            :src="assets + '/users-images/' + user.pic" 
                            class="search-user-img mr-2" 
                            :alt="user.name"
                        >
                        <a 
                            :href="'/search/' + enc(user.id) + '/' + user.slug"
                            :title="user.name"
                            v-html="highlight(user.name)"
                        ></a>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: 'SearchComponent',
    props: {
        assets: {
            type: String,
            required: true
        }
    },
    data () {
        return {
            search: '' ,
            users: []
        }
    }, 
    watch: {
        search () {
            if (! this.search) {
                this.users = []
            }
        }
    },
    methods: {
        userSearch () {
            axios.get('/search', {
                params: {
                    search: this.search
                }
            })
            .then( (response) => {  
                if (response.data.length && this.search) {
                    this.users = response.data.filter(value => {
                        return value.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    });
                } else {
                    // console.log('Data receiving error');
                }
            })
            .catch( (error) => {
                // console.log(error);
            });
        },
        onBlur () {
            setTimeout(() => {
                this.search = '';
                this.users = [];
            }, 100);
        },
        highlight(text) {
            let size = 25;
            if (text.length > size) {
                text = text.substr(0, size) + '...';
            }
            
            return text.replace(new RegExp(this.search, 'gi'), '<span class="text-danger">$&</span>');
        },
        enc (str) {
            var str = str + 'hi';

            var encoded = "";
            for (var i=0; i<str.length;i++) {
                var a = str.charCodeAt(i);
                var b = a ^ 118;    // bitwise XOR with any number, e.g. 123
                encoded = encoded+String.fromCharCode(b);
            }
            return encoded;
        }
    }
};
</script>

<style lang="scss" scoped>

    form.top-search-form {
        margin-left: 0;
        margin-top: 10px;
        margin-bottom: 10px; 
    }

    input.top-search-input {
        width: 0px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        background-image: url('/css-img/searchicon.png');
        background-position: 10px 6px;
        background-repeat: no-repeat;
        padding: 8px 0 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    input.top-search-input:focus {
        width: 100%;
    }

    .search-box {
        position: relative;
    }

    .search-results {
        position: absolute;
        top: 40px;
        left: 0;
        width: 100%;
        max-height: 500px;
        overflow: auto;
        z-index: 1000;

        ul {
            width: 100%;
            padding: 10px;
            margin-bottom: 0;

            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: white;

            li {
                margin-bottom: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid #aaa;

                .search-user-img {
                    width: 50px;
                }

                &:last-of-type {
                    border-bottom: none;
                    margin-bottom: 0;
                    padding-bottom: 0;
                }
            }
        }
    }

    .search-enter-active {
        transform: translateY(0px);
        transition: all .2s linear;
    }

    .search-leave-active {
        transition: all .1s linear;
    }

    .search-enter, .search-leave-to  {
        opacity: 0;
        transform: translateY(-100px);
    }

    @media only screen
    and (min-width: 992px){
        form.top-search-form {
            margin-left: 20px;

            input.top-search-input:focus {
                width: 200%;
            }
        }

        .search-results {
            left: 10px;
            width: 430px;

            ul {
                width: 430px;
            }
        }
    }

    @media only screen
    and (min-width: 768px)
    and (max-width: 992px){
        input.top-search-input:focus {
            width: 150%;
        }

        .search-results {
            left: 10px;
            width: 323px;

            ul {
                width: 323px;
            }
        }
    }

    @media only screen
    and (min-width: 768px){
        form.top-search-form {
            margin-left: 10px;
            margin-top: 0;
            margin-bottom: 0;
        }
    }

</style>
