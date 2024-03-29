@extends("layout")

@section('content')
<div class="d-flex gap-3 flex-wrap justify-content-center h-100" id="list" style="overflow-y: auto">

    @if($posts->count() != 0)
    @foreach($posts as $post)
    
    
    <div class="card" style="width: 18rem; min-height: 200px">
        <a href="{{route("spesificPost", ["id"=>$post->id])}}">
            <img src="{{ asset('storage/posts') . '/' . $post->post_image }}" class="card-img-top object-fit-cover" alt="..." style="height: 250px">
        </a>
            
        </div>
        @endforeach
        @else
        <div>
            Posts kosong
        </div>
        @endif
    </div>

    @endsection

    @section('script')

    <script>
        const mp = document.querySelector(".main-panel")
        const list = document.getElementById("list")

        let currentPage = 1

        mp.addEventListener("scroll", function(){
            // Mendapatkan tinggi total dari halaman
            var totalHeight = this.scrollHeight - this.clientHeight;
  
            // Mendapatkan posisi scroll saat ini
            var scrollPosition = this.scrollY || this.pageYOffset || this.scrollTop;

            // Menghitung persentase scroll
            var scrollPercentage = (scrollPosition / totalHeight) * 100;

            
           
            if(scrollPercentage == 100){
                    const data = new FormData()

                    data.append('_token', '{{ csrf_token() }}');

                    const xhr = new XMLHttpRequest()

                    xhr.open("POST", `{{route('infiniteScroll')}}?page=${currentPage+1}`, true)

                    xhr.onload = (e)=>{
                        const response = JSON.parse(e.target.response)

                        if(currentPage < response.posts.last_page){
                            response.posts.data.map((e)=>{
                                list.innerHTML += `
                                <div class="card" style="width: 18rem; min-height: 200px">
                                    <a href="/post/${e.id}">
                                        <img src="{{ asset('storage/posts') . '/' }}${e.post_image}" class="card-img-top object-fit-cover" alt="..." style="height: 250px">
                                        </a>
                                        
                                        </div>
                                        `
                            })
                            currentPage++
                        }

                    }

                    xhr.send(data)
            }
        })
    </script>

        
    @endsection