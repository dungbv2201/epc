<template>
    <div>
        <div class="main-title" v-show="!isLoading">
            {{store.name }} Menu
        </div>
        <div class="actions">
            <button class="btn-filter" @click="fetchProduct()">Filter</button>
            <select name="" id="" v-model="sortSelect">
                <option value="" hidden>please chose</option>
                <option value="" v-for="item in sort" :value="item.value" :key="item.name">{{ item.name}}</option>
            </select>
        </div>
        <div class="filter">
            <h3>Toppings</h3>
            <div class="topping-list">
                <div v-for="topping in toppings" class="item">
                    <input type="checkbox" v-model="toppingSelect" :value="topping.id">
                    <label for="">{{ topping.name }}</label>
                </div>
            </div>
        </div>
        <div class="products-list" v-if="products.length >0">
            <div class="item" v-for="item in products" :key="item.id">
                <div class="card-header">
                    <div>MT-{{item.id}}</div>
                    <strong class="name">{{ item.name }}</strong>
                </div>
                <div class="toppings">
                    <div>
                        <strong>Toppings:</strong>
                    </div>
                    <span>{{ item.toppings | getTopping }}</span>
                </div>
                <div class="footer">
                    <div class="price">
                        <strong>${{item.price}}</strong>
                    </div>
                    <div class="trend" v-if="item.is_hot == 1">
                        Trending
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="empty">
            <span v-if="!isLoading">Sorry, Have no Product! :(</span>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "Store",
        filters: {
            getTopping(value) {
                var toppings = []
                for (let item of value) {
                    toppings.push(item.name)
                }
                return toppings.join()
            }
        },
        data() {
            return {
                products: [],
                toppings: [],
                toppingSelect: [],
                store:{},
                sort: [
                    {
                        name: 'Name ASC',
                        value: 'name_asc'
                    },
                    {
                        name: 'Name DESC',
                        value: 'name_desc'
                    },
                    {
                        name: 'Price ASC',
                        value: 'price_asc'
                    },
                    {
                        name: 'Price DESC',
                        value: 'price_desc'
                    }
                ],
                sortSelect: '',
                isLoading: true
            }
        },
        watch: {
            sortSelect() {
                this.fetchProduct()
            }
        },
        methods: {
            fetchProduct() {
                axios.get('/api/products/' + this.$route.params.storeId, {
                    params: {
                        toppingIds: this.toppingSelect,
                        sort: this.sortSelect
                    }
                })
                    .then(response => {
                        this.products = response.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
                    .finally(()=>{
                        this.isLoading = false
                    })
            },
            fetchTopping() {
                axios.get('/api/toppings')
                    .then(response => {
                        this.toppings = response.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            fetchStore() {
                axios.get('/api/stores/'+this.$route.params.storeId)
                    .then(response => {
                        this.store = response.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        },
        created() {
            this.fetchProduct()
            this.fetchTopping()
            this.fetchStore()
        }
    }
</script>

<style scoped lang="scss">

    .main-title {
        color: #1f3056;
        font-size: 32px;
        text-align: center;
        margin: 30px;
        min-height: 60px;
    }

    .actions {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;

        .btn-filter {
            background: #1e2f53;
            padding: 10px 30px;
            outline: none;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            letter-spacing: 2px;

            &:hover {
                cursor: pointer;
                box-shadow: 5px 3px 7px #131313b0;
                color: #ff0;
            }
        }

        select {
            background: #1f3056;
            color: #fff;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
        }

        select:focus {
            outline: none;
        }
    }

    .filter {
        background: #fff;
        padding: 10px;
        margin-bottom: 30px;
        padding-bottom: 20px;

        .topping-list {
            display: flex;
            flex-wrap: wrap;
            align-items: center;

            .item {
                display: flex;
                align-items: center;
                margin-right: 10px;

                input[type="checkbox"] {
                    height: 20px;
                    width: 20px;
                    border: 1px solid #1f3056;
                    appearance: none;
                    position: relative;
                    cursor: pointer;
                }

                input:focus {
                    outline: none;
                }

                input[type="checkbox"]:checked:after {
                    content: "";
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 14px;
                    transform: translate(-50%, -50%);
                    height: 14px;
                    background: #1f3056;
                }
            }
        }
    }

    .products-list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: minmax(300px, auto);
        grid-gap: 30px;

        .item {
            color: #1f3056;
            background: #fff;
            border-radius: 6px;
            padding: 30px 20px;
            box-shadow: 9px 6px 10px #aaaaaa85;

            .card-header {
                border-bottom: 2px solid #1f3056;
                padding-bottom: 10px;

                .name {
                    margin: 10px 0;
                    display: block;
                }

            }

            .toppings {
                margin-top: 20px;
            }

            .footer {
                position: relative;
                top: 0;

                .price {
                    text-align: right;
                    margin-top: 100px;
                    font-size: 24px;
                }

                .trend {
                    background: #1e2f53;
                    position: absolute;
                    left: -20px;
                    color: #fff;
                    padding: 5px;
                    padding-left: 20px;
                    width: 40%;
                    top: 0;
                }
            }
        }
    }
    .empty{
        font-size: 30px;
        color: #727e97;
        text-align: center;
        margin-top: 40px;
    }

    @media (max-width: 1024px) {
        .products-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .products-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 475px) {
        .products-list {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            grid-auto-rows: minmax(300px, auto);
            grid-gap: 30px;
        }
    }
</style>
