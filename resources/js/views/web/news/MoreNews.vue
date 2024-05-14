<template>
	<div>
		<section class="page-innerFrame news-fr1 bg-white frame1">
			<div class="page-container">
				<div class="width--90 margin-a newsAr-fr1__list">
					<div class="page-innerFrame__title align-c">
						<h5 class="slideUp">More</h5>
						<h1 class="slideUp">News</h1>
					</div>
					<div  v-if="Object.keys(latestNews).length > 0" class="margin-a news-fr1__container">
						<div class="width--50 news-fr1__leftCon">
							<img :src="latestNews.image_path" alt="news-image" loading="lazy" width="630" height="410">
						</div>
						<div class="width--50 news-fr1__rightCon">
							<h3 class="slideUp font-2 type-1">{{ latestNews.title }}</h3>
							<h5 class="slideUp font-1 type-lighterGray">{{ latestNews.published_date }}</h5>
							<p v-html="latestNews.description"></p>
							<a :href="`/news/view/${ latestNews.id }`"><button class="button type-1"><span>Read More</span><img src="images/images/icons/arrow.png"></button></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="page-frame bg-dullWhite news-fr2 page-lastFrame">

			<div class="page-container">
				<div class="width--90 margin-a news-fr2__newsListCon page-general slideUp">
					<div class="news-fr2__newsListWrapper">
						<template v-if="filteredNews.length">
							<a v-for="news in filteredNews" :href="`/news/view/${ news.id }`" class="news-fr2__newsCard" :key="news.id">
								<div class="news-fr2__newsList">
									<div class="news-fr2__newsImgCon">
										<img :src="news.image_path" alt="news-image" loading="lazy" width="315" height="205">
									</div>
									<h5 class="font-2 type-1">{{ news.title }}</h5>
									<h6 class="font-1 type-lighterGray">{{ news.published_date }}</h6>
									<div class="newsAr-fr2__descCon" v-html="news.description"></div>
								</div>
							</a>
						</template>

						<template v-else>
							<p class="mt-4 mb-4">No news articles yet.</p>
						</template>
					</div>
				</div>
				<!-- <div class="width--90 margin-a cstm-pagination">
					<a href="/news"><button class="cstm-page__prev button type-1"><img src="images/images/icons/arrow.png"><span>Prev</span></button></a>
					<a href="/news" class="cstm-page active">1</a>
					<a href="/news" class="cstm-page">2</a>
					<a href="/news" class="cstm-page">3</a>
					<p class="cstm-page">...</p>
					<a href="/news" class="cstm-page">10</a>
					<a href="/news"><button class="cstm-page__next button type-1"><span>Next</span><img src="images/images/icons/arrow.png"></button></a>
				</div> -->

				<pagination :data="newsData" class="cstm-pagination" @pagination-change-page="fetchNews" />
			</div>
		</section>
	</div>
</template>

<script type="text/javascript">
import LaravelVuePagination from 'laravel-vue-pagination';

	export default{
		components: {
        	'pagination': LaravelVuePagination
    	},

		props: {
			fetchUrl: {
				type: String,
				default: null,
			},
		},

		mounted() {
			this.fetchNews();
		},
		
		data: () => ({
			newsData: {},
			newsList: []
		}),

		computed: {
			latestNews() {
				return this.newsList.length ? this.newsList[0] : {};
			},

			filteredNews() {
				return this.newsList.length ? this.newsList.slice(1) : []
			}
		},

		methods: {
			fetchNews(page = 1) {
				axios.post(`${this.fetchUrl}?page=${page}`)
					.then(response => {
						this.newsData = response.data;
						this.newsList = this.newsData.data;
						console.log(this.newsList);
					}).catch(error => {
							console.log(error);
					});
			}
		}
	}
</script>