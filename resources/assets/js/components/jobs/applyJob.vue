<template>
<div>
	<breadcrumbs 
		:breadcrumbs="this.breadcrumbs" 
		:icon="'suitcase grey icon'"
		:discardbutton="{ 'name': 'jobs.show', params: { id: this.id }}">
	</breadcrumbs>
	<div class="ui container stackable grid">
		<div class="sixteen wide column" v-if="this.loading">
	    <div class="ui segment" style="height:200px;">
	      <div class="ui inverted dimmer" :class="{active: loading}">
	      <div class="ui text large loader">Loading</div>
	      </div>
	    </div>
	  </div>
		<div class="eight wide column" v-if="!this.loading">
			<div class="ui form">
		    <div class="required field" :class="{error : errors.name}">
		      <label>Name</label>
		      <input type="text" v-model="application.name" placeholder="Name" required="required">
		      <div class="ui basic red pointing prompt label transition visible" v-if="errors.name">
		      	{{ errors.name[0] }}
		      </div>
		    </div>
		    <div class="required field" :class="{error : errors.email}">
		      <label>Email name</label>
		      <input type="email" v-model="application.email" placeholder="Email" required="required">
		      <div class="ui basic red pointing prompt label transition visible" v-if="errors.email">
		      	{{ errors.email[0] }}
		      </div>
		    </div>
		    <div class="field">
		      <label>Web Address</label>
		      <input type="text" v-model="application.web_address" placeholder="Last Name">
		    </div>
			  <div class="field">
			    <label>Cover Letter</label>
			    <textarea rows="4" v-model="application.cover"></textarea>
			  </div>
			  <div class="required field" v-if="!read_only">
		      <label>Attachment (CV / Resume)</label>
		      <input type="file" accept=".pdf,.doc,.docx" @change="application.resume = $event.target.value;">
		    </div>
		    <div class="read only field" v-if="read_only">
		    Resume: {{ application.resume }}
		    </div>
		    <div class="inline field">
			    <div class="ui slider vue checkbox">
			      <input type="checkbox" tabindex="0" name="working" v-model="application.like_working">
			      <label for="working">Do you like working?</label>
			    </div>
			    <label></label>
			  </div>
			  <div class="field">
			  	<vue-recaptcha :sitekey="sitekey" @verify="verifyToken"></vue-recaptcha>
			  </div>
			  <div class="field">
			  	<button class="ui primary button" :class="{disabled : !tokenVerifed }" @click="submitForm">Submit Application</button>
			  </div>
			</div>
		</div>
		<div class="eight wide column" v-if="!this.loading">
			<div class="ui segment">
				<h3 class="ui left aligned header">
					Job Description
					<div class="sub header"> {{ job.description }} </div>
				</h3>
			</div>
			<table v-tablesort class="ui celled fluid sortable table" v-if="job">
	      <thead>
	        <tr>
	          <th class="three wide">Title</th>
	          <th class="three wide">Employer</th>
	          <th class="two wide">Location</th>
	          <th class="one wide right aligned">Salary</th>
	          <th class="two wide">Posted At</th>
	        </tr>
	      </thead>
	      <tbody>
	        <tr>
	          <td>
	          	<h4 class="ui left aligned header">
	          		<span>{{ job.title }}</span> 
	          		<div class="sub header" v-if="job.type">Type: {{ job.type }}</div>
	          	</h4>
	          </td>
	          <td>
							{{ job.employer }}
	          </td>
	          <td>
	            {{ job.location }}
	          </td>
	          <td class="right aligned">
	            ${{ job.salary }}
	          </td>
	          <td>
	          	{{ job.post_date }}
	          </td>
	        </tr>
	      </tbody>
	    </table>
	    <div v-else>
	      No Jobs Available!
	    </div>
		</div>
	</div>
</div>
</template>
<script>
import VueRecaptcha from 'vue-recaptcha';
import breadcrumbs from '../breadcrumbs.vue';
export default {
	components: { VueRecaptcha, breadcrumbs },
	props: ['id'],
	created() {
		let t = this;
		NProgress.start();
		if (t.id) {
			t.loadJob();
		}
	},
	mounted() {
		document.title = "Jobify :: Apply for a Job";
		NProgress.done(true);
	},
	data() {
		return {
			loading: false,
			application: this.defaultApplicationParams(),
			job: {},
			sitekey: '6LeT9yoUAAAAAPRFGBHl6UZO7RiWdey2kWKEqVlZ',
			errors: {},
			tokenVerifed: false,
			read_only: false,
			breadcrumbs: [{ 'url': 'jobs', 'name': 'Jobs' }]
		}
	},
	watch: {
		application: {
	    handler(val) {
	    	if (val.name)			{ this.errors.name = null; }
	    	if (val.email)		{ this.errors.email = null; }
	    },
	    deep: true
	  }
	},
	methods: {
		defaultApplicationParams() {
			return {
				"job_id": this.id,
				"name": null,
				"email": null,
				"web_address": null,
				"cover": null,
				"resume": null,
				"like_working": false,
			}
		},
		verifyToken(token) {
			if (token == null || token == '') { return; }
			this.tokenVerifed = true; 
		},
		loadJob() {
			let t = this;
			NProgress.start();
			t.loading = true;
			this.$http.get('/api/v1/jobs/' + this.id, {auth: {username: 'demo@example.com', password: 123456 }})
					.then(
						response => {
							t.job = response.data;
							NProgress.done(true);
							Vue.toasted.info('Job Loaded successfully!');
							t.breadcrumbs = [{ 'url': 'jobs', 'name': 'Jobs' }, { 'url': 'jobs.show', 'name': t.job.title }];
							t.loading = false;
						});
		},
		submitForm() {
			let t = this;
			let formData = this.application;
			console.log(formData);
			NProgress.start();

			if (formData.name === null || formData.email === null) { 
				NProgress.done(true);
				Vue.toasted.error('Please fill all the fields');
				return; 
			}

			t.$http.post('/api/v1/jobs/' + this.id + '/apply', formData, {auth: {username: 'demo@example.com', password: 123456 }})
			.then(response => {
				console.log('response', response.data);
				NProgress.done(true);
				setTimeout(() => {Vue.toasted.success('Application submitted successfully!')}, 2000);
				t.$router.push({ name: 'jobs'});
			})
			.catch(error => {
        if (error.response.data) { t.errors = error.response.data; }
        NProgress.done(true);
        Vue.toasted.error('Uh-oh! Error Happened!');
      });
		}
	}
}
</script>