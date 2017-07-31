<template>
<div>
	<breadcrumbs 
    :breadcrumbs="[{ 'url': 'jobs', 'name': 'Jobs' }, {'url': 'applications', 'name': 'Applications'}]" 
    :icon="'suitcase grey icon'">
  </breadcrumbs>
	<div class="ui container stackable grid">
	  <div class="sixteen wide column" v-if="this.loading">
	    <div class="ui segment" style="height:200px;">
	      <div class="ui inverted dimmer" :class="{active: loading}">
	      <div class="ui text large loader">Loading</div>
	      </div>
	    </div>
	  </div>
	  <div class="sixteen wide column" v-if="!this.loading">
	    
	    <div class="ui icon message">
	      <i class="user icon"></i>
	      <div class="content">
	        <div class="header">
	          Welcome to Job Applications!
	        </div>
	        <p>Here you can check the job applications submitted by users!</p>
	      </div>
	    </div>

	    <div class="ui fluid large icon input">
		    <input type="text" placeholder="Search Application By Name (min 3 characters); Eg. Vinayak" v-model="searchText" autofocus />
		    <i class="search icon"></i>
		  </div>
	    <table class="ui large table">
			  <thead>
			    <tr>
			      <th>Name</th>
			      <th>Email</th>
			      <th>Web Address</th>
			      <th>Rating</th>
			      <th></th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr v-for="(applicant, index) in filteredapplications" :key="applicant.id">
			      <td>{{ applicant.name }}</td>
			      <td>{{ applicant.email }}</td>
			      <td>{{ applicant.web_address }}</td>
			      <td>
			      	<rating v-model="applicant.rating" disabled="true"></rating>
			      </td>
			      <td>
			      	<div class="ui two buttons">
		          	<router-link
		              tag="button"
		              class="ui grey basic purple button"
		              :to="{ name: 'jobs.show', params: { id: applicant.job_id }}" exact>
		              View Job
		            </router-link>
		            <router-link
		              tag="button"
		              class="ui grey basic button"
		              :to="{ name: 'applications.show', params: { id: applicant.id }}" exact>
		              View Application
		            </router-link>
		          </div>
	         	</td>
			    </tr>
			  </tbody>
			</table>
	  </div>
	</div>
</div>
</template>
<script>
import breadcrumbs from '../breadcrumbs.vue';
export default {
	components: { breadcrumbs },
  data() {
    return {
      loading: false,
      searchText: null,
      applications: [],
    }
  },
  created() {
  	this.loadData();
  },
  mounted() {
  	document.title = "Jobify :: List All Applications";
  },
  computed: {
  	filteredapplications() {
  	 let t = this;
  	 if ( t.searchText !== null && t.searchText !== "" ) { 
  	 	return _.filter(t.applications, function(o) { return o.name === t.searchText; });
  	 } else {
  	 	return t.applications; 
     }
    }
  },
  methods: {
    loadData() {
      let t = this;
      this.loading = true;
      NProgress.start();
      t.$http.get('/api/v1/applications', {auth: {username: 'demo@example.com', password: 123456 }})
      .then(response => {
        console.log('reseponse.data', response.data);
        t.applications = response.data;
        t.loading = false;
        NProgress.done(true);
      });
    }
  }
}
</script>