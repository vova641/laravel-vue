<template>
   <div class="container" style="height: 100vh;  width: 100%; margin-top: 100px;">
    <button type="submit" class="btn btn-primary mb-5">
       <router-link :to="{ name: 'posts' }">
						  <a class="nav-link text-white" href="#">Посты</a>
        </router-link>
    </button>
     <button type="submit" class="btn btn-primary mb-5">
       <router-link :to="{ name: 'message' }">
						  <a class="nav-link text-white" href="#">Сообщения</a>
        </router-link>
    </button>
    <button type="submit" class="btn btn-dark mb-5">
       <router-link :to="{ name: 'brons' }">
						  <a class="nav-link text-white" href="#">Брони</a>
        </router-link>
    </button>
    <h1>Все Брони</h1>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Имя</th>
      <th scope="col">Номер</th>
      <th scope="col">Email</th>
      <th scope="col">Бронь</th>
      <th scope="col">Дата записи</th>
      <th scope="col">Удалить</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="bron in brons" :key="bron.id">
      <th scope="row">{{bron.id}}</th>
      <td>{{bron.name}}</td>
      <td>{{bron.phone}}</td>
      <td>{{bron.mail}}</td>
      <td>{{bron.time}}</td>
      <td>{{ moment(bron.created_at).format("DD-MM-YYYY") }}</td>
      <td>
       <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg>
        </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ bron.name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Удалить Бронь?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click.prevent="deleteBron(bron.id) ">Удалить</button>
                </div>
                
                </div>
            </div>
            </div>
      </td>
    </tr>
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li :class="{disabled: !pagination.prev_page_url}"
        @click.prevent="getConts(pagination.prev_page_url)"
        class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Назад</a>
    </li>
    <li class="page-item disabled" >
      <a class="page-link" href="#">Страницы {{pagination.current_page}} из {{pagination.last_page}}</a>
    </li>
    <li :class="{disabled: !pagination.next_page_url}"
        @click.prevent="getConts(pagination.next_page_url)"
         class="page-item">
      <a class="page-link" href="#">Дальше</a>
    </li>
  </ul>
</nav>
    </div>
</template>

<script>

import axios from 'axios'
import moment from "moment"


export default{

   data() {
        return {
           moment: moment,
           drobZone: null,
           brons: [],
           bron: {
               name: '',
               mail: '',
               phone: '',
               time: '',
           },
            bron_id: '',
            pagination:{},
            adit:false,
            loading: true,
            errored: false,
        }
    },
    mounted() {
        this.getBrons()
    },
    methods: {
      getBrons(page_url) {

            page_url = page_url || '/api/brons'

            axios
                .get(page_url)
                .then(response => {
                    this.brons = response.data.data
                    this.makePagination(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        this.errored = true;
                    })
                    .finally(() => this.loading = false)
        },

        makePagination(response){
          let pagination = {
            current_page: response.current_page ,
            last_page: response.last_page ,
            prev_page_url: response.prev_page_url ,
            next_page_url: response.next_page_url ,
          }

          this.pagination = pagination
          console.log(this.pagination)

        },
        deleteBron(id){
          axios
          .delete(`/api/brons/${id}`)
           .then(response =>{
             this.getBrons()
             console.log(response)
           })
           .catch(error => console.log(error))
        }
    },
}
</script>
