<template>
    <div class="dv">
        <div class="dv-body">
            <table class="dv-table">
                <thead>
                <tr>
                    <th  v-for="column in columns" >
                        <div @click="toggleOrder(column)">
                            <span>{{column}}</span>
                            <span class="dv-table-column" v-if="column === query.column">
                                <span v-if="query.direction === 'desc'">&darr;</span>
                                <span v-else>&uarr;</span>
                            </span>
                        </div>
                        <select v-model="searchValue[column]" v-if="column in dropdown" @change="filterValue()">
                            <option></option>
                            <option v-for="(item,index) in dropdown[column]" :value="index">{{item}}</option>
                        </select>
                        <input v-else v-model="searchValue[column]" @change="filterValue()"/>

                    </th>
                </tr>
                </thead>
                <tbody>


                    <tr v-for="row in model.data"  >
                        <td v-for="column in columns">{{typeof row[column] === 'object' ? row[column].name : row[column] }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="dv-footer">
            <div class="dv-footer-item">
                <span>Displaying {{model.from}} - {{model.to}} of {{model.total}} rows</span>
            </div>
            <div class="dv-footer-item">
                <div class="dv-footer-sub">
                    <span>Rows per page</span>
                    <input type="text" v-model="query.per_page"
                           class="dv-footer-input"
                           @keyup.enter="fetchIndexData()">
                </div>
                <div class="dv-footer-sub">
                    <button class="dv-footer-btn" @click="prev()">&laquo;</button>
                    <input type="text" v-model="query.page"
                           class="dv-footer-input"
                           @keyup.enter="fetchIndexData()">
                    <button class="dv-footer-btn" @click="next()">&raquo;</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    //similar to vue-resource
    export default {
        props: ['source'],
        data() {
            return {
                searchValue:{},
                dropdown:{},
                model: {},
                columns: {},
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'desc',
                    per_page: 20
                }
            }
        },
        created() {
            this.fetchIndexData()
        },
        methods: {
            filterValue(value){
                this.fetchIndexData();
              //  console.log(this.searchValue,'searchValue')
            },
            next() {
                if(this.model.next_page_url) {
                    this.query.page++;
                    this.fetchIndexData()
                }
            },
            prev() {
                if(this.model.prev_page_url) {
                    this.query.page--;
                    this.fetchIndexData()
                }
            },
            toggleOrder(column) {
                if(column === this.query.column) {
                    // only change direction
                    if(this.query.direction === 'desc') {
                        this.query.direction = 'asc'
                    } else {
                        this.query.direction = 'desc'
                    }
                } else {
                    this.query.column = column
                    this.query.direction = 'asc'
                }
                this.fetchIndexData()
            },
            fetchIndexData() {
                var vm = this;
                let filter = '';
                console.log(this.searchValue,'this.searchValue')
                for(let filterName in this.searchValue){
                    filter+=`${filterName}=${this.searchValue[filterName]}&`
                }
                filter = filter.slice(0,filter.length-1)
               // console.log(filter,'filterrrrrrr')
                axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&${filter}`)
                    .then(function(response) {
                        let model = response.data.model;
                        console.log(response,'ressssss')
                        Vue.set(vm.$data, 'model', model);
                        Vue.set(vm.$data, 'columns', response.data.columns);
                        Vue.set(vm.$data, 'dropdown', response.data.dropdown);
                    })
                    .catch(function(response) {
                        console.log(response)
                    })
            }
        }
    }
</script>
