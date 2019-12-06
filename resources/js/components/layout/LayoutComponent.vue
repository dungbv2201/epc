<template>
    <div class="container-fluid">
        <div class="app-main">
            <div class="side-bar">
                <div class="title">Milk Tea Store</div>
                <ul class="menu">
                    <li v-for="item in menu" :key="item.title"
                                :class="{'active': $route.params.storeId == item.id}"
                    >
                                <router-link :to="{name:'store',params:{storeId: item.id}}">
                                    {{ item.title }}
                                </router-link>
                    </li>
                </ul>
            </div>
            <div class="main">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LayoutComponent",
        data() {
            return {
                menu: [
                    {
                        'title': 'Store1',
                        'id': 1
                    },
                    {
                        'title': 'Store2',
                        'id': 2
                    },
                    {
                        'title': 'Store3',
                        'id': 3
                    },
                    {
                        'title': 'Store4',
                        'id': 4
                    }
                ]
            }
        },
        mounted() {
            this.$nextTick(() => {
                document.querySelector('.side-bar').style.height = window.innerHeight + 'px'
            })
        }
    }
</script>

<style scoped lang="scss">
    .app-main {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-auto-rows: minmax(100px, auto);
        grid-template-areas: "sidebar main main main main main";
        margin: 0 auto;

        .side-bar {
            background: #1e2f53;
            grid-area: sidebar;
            min-height: 100vh;

            .title {
                color: #fff;
                margin: 20px;
                font-size: 24px;
                text-align: center;
            }

            .menu {
                li {
                    padding: 20px;
                    font-size: 20px;
                    text-align: center;
                    list-style: none;

                    &:hover {
                        background: #2e4676;
                        cursor: pointer;
                        a{
                            color: #fff;
                        }
                    }
                    a{
                        color: #727e97;
                        text-decoration: none;
                    }

                    &.active {
                        border-left: 4px solid #ff0;
                        background: #2e4676;
                        a{
                            color: #fff;
                        }
                    }
                }
            }
        }

        .main {
            background: #F0F0F0;
            grid-area: main;
        }
    }
</style>
