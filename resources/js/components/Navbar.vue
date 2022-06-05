<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
		<div class="container">
			<a class="navbar-brand" href="#"><span>Нефер</span>тити</a> <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<router-link :to="{ name: 'home' }">
               <a class="nav-link" href="#">Главная</a>
            </router-link>
					</li>
					
					<li class="nav-item">
            <router-link :to="{ name: 'new' }">
						  <a class="nav-link" href="#">Новости</a>
            </router-link>
					</li>
					<li class="nav-item">
						 <router-link :to="{ name: 'conts' }">
						  <a class="nav-link" href="#">Контакты</a>
            </router-link>
					</li>
		
          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo me-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item ps-3">
                <fa icon="cog" fixed-width />
                {{ $t('settings') }}
              </router-link>
               
              <router-link :to="{ name: 'posts' }" class="dropdown-item ps-3" v-if="user.id === 1">
                <fa icon="user" fixed-width />
                {{ $t('Админ понель') }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item ps-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('logout') }}
              </a>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" active-class="active">
                 <a class="getstarted">{{ $t('Войти') }}</a>
              </router-link>
            </li>
          </template>
				</ul>
			</div>
		</div>
	</nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}

.container {
  max-width: 1100px;
}
</style>
