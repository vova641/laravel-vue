<template>

    <div style="height: 78vh;  width: 100%; margin-top: 100px;">
     
         <section class="Material-contact-section section-padding section-dark">
         
      <div class="container">
          <div class="row">
              <!-- Section Titile -->
              <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                  <h1 class="section-title">Love to Hear From You</h1>
              </div>
          </div>
          <div class="row">
              <!-- Section Titile -->
              <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p>

                <div class="find-widget">
                 Company:  <a href="https://hostriver.ro">HostRiver</a>
                </div>
                <div class="find-widget">
                 Address: <a href="#">4435 Berkshire Circle Knoxville</a>
                </div>
                <div class="find-widget">
                  Phone:  <a href="#">+ 879-890-9767</a>
                </div>
                
                <div class="find-widget">
                  Website:  <a href="https://uny.ro">www.uny.ro</a>
                </div>
                <div class="find-widget">
                   Program: <a href="#">Mon to Sat: 09:30 AM - 10.30 PM</a>
                </div>
              </div>
              <!-- contact form -->
              <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                  <form @submit.prevent="addCont()" class="shake" data-toggle="validator">
                      <!-- Name -->
                      <div class="form-group label-floating">
                        <label class="control-label" for="name">Name</label>
                        <input v-model="cont.name" class="form-control" id="name" type="text" name="name" required data-error="Please enter your name">
                        <div class="help-block with-errors"></div>
                      </div>
                      <!-- email -->
                      <div class="form-group label-floating">
                        <label class="control-label" for="email">Email</label>
                        <input v-model="cont.mail"  class="form-control" id="email" type="email" name="email" required data-error="Please enter your Email">
                        <div class="help-block with-errors"></div>
                      </div>
                      <!-- Message -->
                      <div class="form-group label-floating">
                          <label for="message" class="control-label">Message</label>
                          <textarea v-model="cont.text"  class="form-control" rows="3" id="message" name="message" required data-error="Write your message"></textarea>
                          <div class="help-block with-errors"></div>
                      </div>
                      <!-- Form Submit -->
                      <div class="form-submit mt-5">
                          <button class="btn btn-common" type="submit" id="liveToastBtn" ><i class="material-icons mdi mdi-message-outline"></i> Send Message</button>
                          <div id="msgSubmit" class="h3 text-center hidden"></div>
                          <div class="clearfix"></div>
                      </div>
                  </form>
              </div>
          </div>
          
      </div>
    </section>
    
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