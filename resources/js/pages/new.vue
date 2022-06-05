<template>
<section class="portfolio section-padding" id="portfolio" style="margin-top: 100px; ">
		<div class="container ">
			<div class="row">
				<div class="col-md-12">
					<div class="section-header text-center pb-5">
						<h2>Новости парикмахерской</h2>
						<h1 class="t-bold"><span>Нефер</span>тити</h1>
					</div>
				</div>
			</div>
			
			<div class="row ">
            
				<div class="col-12 col-md-12 col-lg-4 mb-3"  v-for="post in posts" :key="post.id">
                
				<div class="card ">
					<img :src="post.img" class="card-img-top" alt="Hollywood Sign on The Hill"/>
					<div class="card-body">
						<h5 class="card-title">{{post.title}}</h5>
						<p class="card-text">{{post.text}}</p>
						<small class="text-muted">Запись опубликована в {{ moment(post.created_at).format("D MMM hh:mm") }}</small>
					</div>
					</div>
				</div>
                
			</div>
		</div>
		<nav aria-label="Page navigation example" style="margin: 50px 0;">
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
	</section>

	
</template>

<script>

import { faThemeisle } from '@fortawesome/free-brands-svg-icons'
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
    },
}
</script>