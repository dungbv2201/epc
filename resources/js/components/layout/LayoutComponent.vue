<template>
    <div class="container-fluid">
        <div class="app-main">
            <div class="side-bar">
                <div class="title">
                    Milk Tea Store
                   <div class="toggle-menu" @click="isShowMenu = !isShowMenu">
                       <span></span>
                       <span></span>
                       <span></span>
                   </div>
                </div>
                <ul :class="['menu ',{'menu-hidden': isShowMenu}]">
                    <li v-for="item in stores" :key="item.id" @click="isShowMenu = true"
                        :class="{'active': Number($route.params.storeId) === item.id}">
                        <router-link :to="{name:'store',params:{storeId: item.id}}">
                            {{ item.name }}
                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="main">
                <router-view :key="$route.fullPath"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "LayoutComponent",
        data() {
            return {
                stores: [],
                isShowMenu: true
            }
        },
        mounted() {
            this.$nextTick(() => {
                document.querySelector('.side-bar').style.height = window.innerHeight + 'px'
            })
            this.fetchStore()
        },
        methods: {
            fetchStore() {
                axios.get('/api/stores')
                    .then(response => {
                        this.stores = response.data
                    })
            },
            toggleMenu(){
                document.querySelector('.side-bar .menu').style.display = 'block'
            }
        }
    }
</script>

<style scoped lang="scss">
    .app-main {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-template-areas: "sidebar main main main main main";
        margin: 0 auto;

        .side-bar {
            background: #1e2f53;
            grid-area: sidebar;
            min-height: 100vh;
            height: 100% !important;

            .title {
                color: #fff;
                margin: 20px;
                font-size: 24px;
                text-align: center;
                .toggle-menu{
                    display: none;
                }
            }

            .menu {
                 padding-left: 0;
                 li {
                     padding: 20px;
                     font-size: 20px;
                     text-align: center;
                     list-style: none;

                     &:hover {
                         background: #2e4676;
                         cursor: pointer;

                         a {
                             color: #fff;
                         }
                     }

                     a {
                         color: #727e97;
                         text-decoration: none;
                     }

                     &.active {
                         border-left: 4px solid #ff0;
                         background: #2e4676;

                         a {
                             color: #fff;
                         }
                     }
                 }
             }
        }

        .main {
            background: #F0F0F0;
            grid-area: main;
            padding: 70px;
            padding-top: 30px;
        }
    }
    @media screen and (max-width: 1024px){
        .app-main {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            grid-template-areas: "sidebar sidebar main main main main main main";
            margin: 0 auto;
        }
    }
    @media (max-width: 768px){
        .app-main {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            grid-template-areas:
                "sidebar"
                "main";
            margin: 0 auto;
        }
        .side-bar {
            min-height: inherit !important;
            height: auto !important;
            .title{
                position: relative;
                .toggle-menu{
                    display: block !important;
                    position: absolute;
                    height: 30px;
                    width: 30px;
                    right: 0;
                    top:0;
                    cursor: pointer;
                    span{
                        height: 4px;
                        width: 100%;
                        display: block;
                        background: #fff;
                        margin-bottom: 5px;
                    }
                }
            }
        }
        .menu.menu-hidden{
            display: none;
        }
    }
    @media(max-width: 475px) {
        .app-main {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            grid-template-areas:
                "sidebar"
                "main";
            margin: 0 auto;
            .main{
                padding: 30px;
            }
        }
    }
</style>
