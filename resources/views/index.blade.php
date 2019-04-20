@extends('layouts.app')
@section('title', "| Home")

@section('content')

<div class="row">

    @include('layouts.left-sidebar')

    <div class="col-lg-6 order-lg-2 col-md-12 order-3 text-justify feature-item rounded py-3 px-1">
        <div class="shadow">
            <div class="p-2">
                <h4 class="pt-3 text-center shadow-text">@lang('main.welcome')</h4>
                <p class="p-2">
                    Social networking is the use of internet-based social media sites to stay connected with friends, family, colleagues, customers, or clients. Social networking can have a social purpose, a business purpose, or both. Try our website to achieve that. Social networking has become a significant base for marketers seeking to engage customers.
                </p>
                <div class="text-center">
                    <img src="{{ asset('storage/main/soc-net2.png') }}" alt="main-pic-1" class="img-fluid">
                </div>
                <p class="p-2">
                    Marketers use social networking for increasing brand recognition and encouraging brand loyalty. Since it makes a company more accessible to new customers and more recognizable for existing customers, social networking helps promote a brand’s voice and content.
                    <br>
                    Customers may complement the company’s offerings and encourage others to buy the products or services. The more customers are talking about a company on social networking, the more valuable the brand authority becomes. As a brand grows stronger, more sales result. Increased company posts rank the company higher in search engines. Social networking can help establish a brand as legitimate, credible, and trustworthy.
                    <br>
                    A company may use social networking to demonstrate its customer service level and enrich its relationships with consumers. For example, if a customer complains about a product or service on Twitter, the company may address the issue immediately, apologize, and take action to make it right. However, criticism of a brand can spread very quickly on social media. This can create a virtual headache for a company's public relations department.
                </p>
                <div class="text-center">
                    <img src="{{ asset('storage/main/soc-net1.jpg') }}" alt="main-pic-1" class="img-fluid">
                </div>
                <p class="p-2">
                    Social media is computer-based technology that facilitates the sharing of ideas, thoughts, and information through the building of virtual networks and communities. By design, social media is internet-based and gives users quick electronic communication of content. Content includes personal information, documents, videos, and photos. Users engage with social media via computer, tablet or smartphone via web-based software or web application, often utilizing it for messaging.
                    <br>
                    Social media originated as a way to interact with friends and family but was later adopted by businesses which wanted to take advantage of a popular new communication method to reach out to customers. The power of social media is the ability to connect and share information with anyone on Earth, or with many people simultaneously.
                </p>
                <div class="text-center">
                    <img src="{{ asset('storage/main/soc-net3.jpg') }}" alt="main-pic-1" class="img-fluid">
                </div>
                <p class="p-2">
                    A social network is a set of people who interact. This includes group organizations. The social relationships may include friendship/affect, communication, economic transactions, interactions, kinship, authority/hierarchy, trust, social support, diffusion, contagion, and so on.
                    <br>
                    Calling social relationships a network calls attention to the pattern or structure of the set of relationships.
                    <br>
                    A community social network is the pattern of relationships among a set of people and/or organizations in a community. Each of these networks can involve social support, give people a sense of community, and lead them to help and protect each other.
                    <br>
                    How big a personal network becomes depends on the individual and the type of relationships considered. The set of people that a person knows well or with whom a person frequently interacts seldom exceeds several hundred. As the size of a network grows, keeping relationships is strained by the size. There is a so-called "Law of 150" which suggests that about 150 people is the best size for a village or large clan though most people live in much bigger towns. Some experts think that a corporation has an ideal size of about 70 people: these people and their spouses would also make a large social network.
                </p>
                <div class="text-center">
                    <img src="{{ asset('storage/main/soc-net4.jpg') }}" alt="main-pic-1" class="img-fluid">
                </div>
                <p class="p-2">
                    The free rider problem is that someone uses the social network but does not give help when needed. Social networks are vulnerable to them, since the circumstances where help is required, like disasters, occur by surprise. It might happen that someone cannot help at that one time - it might also happen that they are not there the next time. Only slowly does it become obvious who is and is not contributing to the safety of the group, or who is avoiding this duty.
                    <br>
                    Social networks are held together by common interest. This may be employment, common interest in a sport or pastime, a religion (a mosque, church or temple is almost always a center of a social network). Often the network has an identity of its own which is quite real, even though it may have no official recognition. Networks may be centered on places, or on families, or on worldwide communities with common interests.
                </p>
            </div>
        </div>
    </div>

    @include('layouts.right-sidebar')

</div>

@endsection
