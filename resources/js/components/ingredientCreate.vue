<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>

                    <tr v-for="ingredient in ingredients">
                        <td>{{ingredient.id}}</td>
                        <td>{{ingredient.name}}</td>
                        <td>{{ingredient.price}}$</td>
                    </tr>

                    <tr>
                        <td>New ingredient</td>
                        <td><input type="text" placeholder="input name" v-model="newIngredient.name"></td>
                        <td><input type="text" placeholder="input price" v-model="newIngredient.price"></td>
                        <td><button class="btn btn-success" v-on:click="create">Add</button></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ingredients'],
        data: function() {
            return {
                newIngredient: {
                    name: '',
                    price: ''
                }
            };
        },
        mounted() {
            this.fetch();
        },
        methods: {
            fetch : function () {
                axios.get('/ingredients/list').then((res) => {
                    this.ingredients = res.data.data;
                });
            },
            create: function() {
                axios.post('/ingredient/create', this.newIngredient).then((res) => {
                    this.ingredients.push(res.data);
                });
            }
        }
    }
</script>
