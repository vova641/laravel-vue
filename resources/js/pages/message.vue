<template>
<main class="container" style="height: 100vh;  width: 100%; margin-top: 100px;">
<button type="submit" class="btn btn-primary mb-5">
       <router-link :to="{ name: 'posts' }">
						  <a class="nav-link text-white" href="#">Посты</a>
        </router-link>
    </button>
     <button type="submit" class="btn btn-dark mb-5">
       <router-link :to="{ name: 'message' }">
						  <a class="nav-link text-white" href="#">Сообщения</a>
        </router-link>
    </button>
    <button type="submit" class="btn btn-primary mb-5">
       <router-link :to="{ name: 'brons' }">
						  <a class="nav-link text-white" href="#">Брони</a>
        </router-link>
    </button>
  <div class="d-flex align-items-center p-3 my-3 text-dark bg-purple rounded shadow-sm">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-paper-fill" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M6.5 9.5 3 7.5v-6A1.5 1.5 0 0 1 4.5 0h7A1.5 1.5 0 0 1 13 1.5v6l-3.5 2L8 8.75l-1.5.75ZM1.059 3.635 2 3.133v3.753L0 5.713V5.4a2 2 0 0 1 1.059-1.765ZM16 5.713l-2 1.173V3.133l.941.502A2 2 0 0 1 16 5.4v.313Zm0 1.16-5.693 3.337L16 13.372v-6.5Zm-8 3.199 7.941 4.412A2 2 0 0 1 14 16H2a2 2 0 0 1-1.941-1.516L8 10.072Zm-8 3.3 5.693-3.162L0 6.873v6.5Z"/>
    </svg>
    <div class="lh-3" style="margin-left: 10px" >
      <h1 class="h6 mb-0 text-dark lh-1 ">Почта</h1>
      <small class="text-dark">{{ moment().format("D MMM, h:mm:ss") }}</small>
    </div>
  </div>
<div  class="my-3 p-3  rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Сообщения</h6>
    <div class="d-flex text-muted pt-3"  v-for="cont in conts" :key="cont.id">
      <div class="pb-3 mb-0 small lh-sm border-bottom" style="width: 100%">
        <div class="d-flex justify-content-between">
           <span class="d-block text-gray-dark"><strong class="">{{cont.name}}</strong> {{cont.mail}}  </span>
         <button type="button" class="btn btn-danger" style="margin-left: 65%;" data-bs-dismiss="modal" @click.prevent="deleteCont(cont.id) ">Удалить</button>
        </div>
        <span class="">{{cont.text}}</span>
      </div>
    </div>
  </div>
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
</main>
</template>

<script>
import axios from 'axios'
import moment from "moment"


export default{

    data() {
        return {
           moment: moment,
           drobZone: null,
           conts: [],
           cont: {
               id: '',
               title: '',
               img: '',
               title: '',
               description: '',
           },
            cont_id: '',
            pagination:{},
            adit:false,
            loading: true,
            errored: false,
        }
    },
    mounted() {
        this.getConts()
    },
    methods: {
        getConts(page_url) {

            page_url = page_url || '/api/conts'

            axios
                .get(page_url)
                .then(response => {
                    this.conts = response.data.data
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
        deleteCont(id){
          axios
          .delete(`/api/conts/${id}`)
           .then(response =>{
             this.getConts()
             console.log(response)
           })
           .catch(error => console.log(error))
        },
        addCont(){
          
            axios
              .post('/api/conts',{
                name: this.cont.name,
                mail: this.cont.mail,
                text: this.cont.text,
              })
              .then(response =>{
                this.cont.name = ''
                this.cont.mail = ''
                this.cont.text = ''
                this.getConts()
               
                console.log(response)
              })
              .catch(error => console.log(error))
          
        }
    },
}
</script>

<style lang="scss" scoped>

</style>