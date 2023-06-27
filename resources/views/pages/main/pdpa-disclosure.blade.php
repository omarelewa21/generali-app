@extends('templates.master')

@section('title')
<title>Welcome</title>
@endsection

@section('content')
<div class="container-fluid overflow-hidden">
    <div class="row vh-100 overflow-auto">
        <div class="col-12 col-sm-3 col-xl-3 px-sm-2 px-0 bg-primary d-flex sticky-top">
            
            @include('templates.nav.nav-white')

            <div class="nav-header text-white mx-4">
                <h4 class="display-5 font-bold fw-bold px-4 mt-4">To begin,
                    may we have permission to share or use your personal details?</h4>
            </div>
        </div>
        <div class="col d-flex flex-column h-sm-100">
            <main class="row overflow-auto bg-accent-bg-grey">
                <div class="col pt-4 py-2">
                    <h1 class="display-2 px-4 pt-4 text-uppercase">Your Agreement</h1>
                    <p class="p-4 welcome" style="padding-top:23px;">Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Curabitur
                        tincidunt, velit sodales
                        congue ornare, orci purus semper tortor, at vehicula eros lorem ac elit. Morbi erat turpis,
                        tristique quis euismod et, varius id eros. Pellentesque ultricies, neque vitae elementum
                        sodales, nisi dolor ornare tellus, eget feugiat est risus sed magna. Duis dictum placerat
                        nunc, et ullamcorper ex euismod at. Nunc sit amet fermentum elit. Donec convallis blandit
                        arcu, id pretium mi euismod nec. Morbi suscipit massa at interdum consectetur. Pellentesque
                        volutpat sagittis diam non sodales. Sed non risus in turpis pellentesque suscipit. Nam at
                        eleifend nulla, at ultricies lectus. Nunc consequat ullamcorper malesuada.

                        Donec id ipsum volutpat, pharetra ante ut, dictum tortor. Aenean pharetra ornare tellus, non
                        luctus leo lobortis quis. Proin venenatis augue sit amet lacus finibus ultricies. In hac
                        habitasse platea dictumst. In ante eros, auctor vitae lacus non, venenatis hendrerit justo.
                        In sed lorem orci. Vivamus sit amet lacus ultricies, tempus metus vitae, ultricies elit.
                        Vivamus ultrices consequat imperdiet. Nullam at dolor in nunc finibus vehicula quis non
                        odio. Aenean imperdiet tincidunt dui sit amet posuere.

                        Mauris venenatis sagittis vehicula. Interdum et malesuada fames ac ante ipsum primis in
                        faucibus. In cursus sollicitudin efficitur. Duis sed iaculis erat, non pellentesque libero.
                        Curabitur purus lacus, ullamcorper non risus non, lobortis vehicula sem. Praesent lobortis
                        rutrum risus finibus mattis. Nulla lorem leo, rutrum vitae ante et, vulputate dictum quam.
                        Proin sagittis facilisis nulla quis feugiat. Fusce quis mi magna.

                        Pellentesque sed lorem eget risus pulvinar ullamcorper id aliquam nunc. Proin ut suscipit
                        leo, id fringilla nulla. Etiam ac euismod elit. Vestibulum leo mi, suscipit vel iaculis ut,
                        pellentesque aliquam orci. Praesent urna nunc, sagittis sed tellus non, fermentum convallis
                        dolor. In hac habitasse platea dictumst. Nulla ultricies est lacus, et vulputate velit
                        semper quis. Etiam eu ligula vitae odio facilisis varius vel a lacus. Aliquam eu ligula
                        congue, aliquet dui et, convallis ipsum.

                        Aliquam vehicula augue eu felis euismod porttitor. Vestibulum id enim luctus, scelerisque
                        ante eu, venenatis orci. Curabitur dignissim ligula et eros bibendum, non aliquet urna
                        ultricies. Integer fringilla metus vitae lectus vulputate consectetur. Vestibulum ante ipsum
                        primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras aliquam sapien eu
                        magna gravida venenatis. Aliquam vulputate vel quam eget lobortis. Suspendisse in erat
                        commodo, sollicitudin felis id, rhoncus nulla. Ut semper, leo semper egestas interdum, dolor
                        tortor pellentesque orci, vel molestie tellus leo commodo nisi. Aenean non metus purus.
                        Morbi semper, dui ac aliquam eleifend, sem quam blandit diam, sed auctor felis massa at
                        nisi.

                        Nulla facilisi. In vestibulum iaculis sagittis. Cras id erat quis dui egestas tincidunt sit
                        amet sit amet libero. Mauris feugiat risus ut metus fermentum, sit amet ultrices diam
                        fermentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                        turpis egestas. Nunc hendrerit felis vitae aliquet congue. Cras lacinia mollis tristique. Ut
                        fermentum eu lectus vitae tempor. Sed congue dignissim dui quis ultricies. Sed ac magna
                        tincidunt, malesuada tellus vitae, mattis tortor. Quisque a imperdiet libero, non ultrices
                        sapien. Ut dictum elementum varius. Morbi vestibulum metus arcu, vel venenatis ex gravida
                        at. Aenean condimentum, ipsum pellentesque facilisis scelerisque, purus eros vulputate ex,
                        sit amet aliquet leo felis ac ipsum.
                    </p>
                </div>
            </main>
            <div class="row bg-white py-4 mt-auto">
                <div class="col d-flex justify-content-end">
                    <a href="{{route('welcome')}}" class="btn btn-primary">DECLINE</a>
                    <a href="{{route('basic.details') }}" class="btn btn-primary mx-2">ACCEPT</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection