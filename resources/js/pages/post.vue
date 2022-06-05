<template>
<div class="container" style="height: 100vh;  width: 100%; margin-top: 100px;">
	  <button type="submit" class="btn btn-dark mb-5">
       <router-link :to="{ name: 'posts' }">
						  <a class="nav-link text-white" href="#">Посты</a>
        </router-link>
    </button>
     <button type="submit" class="btn btn-primary mb-5">
       <router-link :to="{ name: 'message' }">
						  <a class="nav-link text-white" href="#">Сообщения</a>
        </router-link>
    </button>
    <button type="submit" class="btn btn-primary mb-5">
       <router-link :to="{ name: 'brons' }">
						  <a class="nav-link text-white" href="#">Брони</a>
        </router-link>
    </button>
<h1>Все записи</h1>
  <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop12">Добавить</button>
  <div class="modal fade" id="staticBackdrop12" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel12" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel12">{{ post.title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form @submit.prevent="addPost()">
                <div class="modal-body">
                
                    <div class="mb-3">
                      <label for="title" class="form-label">Название</label>
                      <input v-model="post.title" type="text" class="form-control" id="title" placeholder="Название">
                    </div>
                    <div class="mb-3">
                      <label for="title" class="form-label">URL-на изоброжение</label>
                      <input v-model="post.img" type="text" class="form-control" id="title" placeholder="изображение">
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Описание</label>
                      <input v-model="post.description" type="text" class="form-control" id="description" placeholder="Название">
                    </div>
                    <div class="mb-3">
                      <label for="text" class="form-label">Text</label>
                      <textarea v-model="post.text" class="form-control" id="text" rows="3"></textarea>
                    </div>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
              </form>
              </div>
            
          </div>
        </div>


<div v-if="errored" class="alert alert-danger" role="alert"> 
  Запись не загружина
</div>


<table v-else class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Название</th>
      <th scope="col">Описание</th>
      <th scope="col">Дата опубликования</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="post in posts" :key="post.id">
      <td>{{ post.id }}</td>
      <td>{{ post.title }}</td>
      <td>{{ post.description }}</td>
      <td> {{ moment(post.created_at).format("DD-MM-YYYY") }}</td>
      
        <td>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ post.title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Вы точно хотите удалить эту запись!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click.prevent="deletePost(post.id) ">Удалить</button>
              </div>
              
            </div>
          </div>
        </div>

        
      <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
           </svg>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel1">{{ post.title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                        <h3>Название: {{ post.title }}</h3>
                        <h5>Описание: {{ post.description }}</h5>
                        <p>Текст: {{ post.text }}</p>
                        <img :src="post.img" alt="" style="width: 400px ;">
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
        @click.prevent="getPosts(pagination.prev_page_url)"
        class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Назад</a>
    </li>
    <li class="page-item disabled" >
      <a class="page-link" href="#">Страницы {{pagination.current_page}} из {{pagination.last_page}}</a>
    </li>
    <li :class="{disabled: !pagination.next_page_url}"
        @click.prevent="getPosts(pagination.next_page_url)"
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
           posts: [],
           post: {
               id: '',
               title: '',
               img: '',
               title: '',
               description: '',
           },
            post_id: '',
            pagination:{},
            adit:false,
            loading: true,
            errored: false,
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts(page_url) {

            page_url = page_url || '/api/posts'

            axios
                .get(page_url)
                .then(response => {
                    this.posts = response.data.data
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
        deletePost(id){
          axios
          .delete(`/api/posts/${id}`)
           .then(response =>{
             this.getPosts()
             console.log(response)
           })
           .catch(error => console.log(error))
        },
        addPost(){
          
            axios
              .post('/api/posts',{
                title: this.post.title,
                img: this.post.img,
                text: this.post.text,
                description: this.post.description
              })
              .then(response =>{
                this.post.title = ''
                this.post.text = ''
                this.post.img = ''
                this.post.description = ''
                this.getPosts()
               
                console.log(response)
              })
              .catch(error => console.log(error))
          
        }
    },
}
</script>