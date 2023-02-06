<div>
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 ">
            @foreach($posts as $post)
                <div>
                    <a href="{{route('posts.show',['user'=>$post->user,'post'=>$post])}}">
                        <img src="{{asset('uploads').'/'.$post->image}}"
                             alt="Imagen del post {{$post->title}}">
                    </a>
                </div>

            @endforeach
        </div>
        <div class="my-10">
            {{$posts->links('')}}
        </div>

    @else
        <p class="text-center">NO HAY POSTS</p>
    @endif
</div>
