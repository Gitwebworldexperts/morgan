@extends('admin.adminLayout')
@section('title', "Settings")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Site Settngs</p>
            <div class="section_content">
               <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Header</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Footer</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">FAQs</button>
                    <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false" >Disabled</button>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                      <div class="row">
                          <div class="col-12 internal_tab_section">
                                <iframe class="internal_iframe" id="internal_iframe" src="{{ route('header_sections.index') }}" width="100%" height="600px" style="border: none;"></iframe>      
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                      <iframe class="internal_iframe" id="footer_iframe" src="{{ route('footer_sections.index') }}" width="100%" height="600px" style="border: none;"></iframe>
                  </div>
                  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                      <iframe class="internal_iframe" id="faq_iframe" src="{{ route('faq.index') }}" width="100%" height="600px" style="border: none;"></iframe>
                  </div>
                  <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">Disabled</div>
                </div>
            </div>
    </section>

@endsection

@section('scripts')    
<script>
    document.getElementById('internal_iframe').onload = function() {
        const iframeDoc = this.contentDocument || this.contentWindow.document;

        // Hide the left sidebar
        const leftSidebar = iframeDoc.querySelector('.left_sidebar');
        if (leftSidebar) {
            leftSidebar.style.display = 'none';
        }

        const right_block = iframeDoc.querySelector('#header_right_block');
        if (right_block) {
        right_block.style.setProperty('margin', '0', 'important');
        }
    };
    document.getElementById('footer_iframe').onload = function() {
        const iframeDoc = this.contentDocument || this.contentWindow.document;

        // Hide the left sidebar
        const leftSidebar = iframeDoc.querySelector('.left_sidebar');
        if (leftSidebar) {
            leftSidebar.style.display = 'none';
        }

        const right_block = iframeDoc.querySelector('#header_right_block');
        if (right_block) {
        right_block.style.setProperty('margin', '0', 'important');
        }
    };
    document.getElementById('faq_iframe').onload = function() {
        const iframeDoc = this.contentDocument || this.contentWindow.document;

        // Hide the left sidebar
        const leftSidebar = iframeDoc.querySelector('.left_sidebar');
        if (leftSidebar) {
            leftSidebar.style.display = 'none';
        }

        const right_block = iframeDoc.querySelector('#header_right_block');
        if (right_block) {
        right_block.style.setProperty('margin', '0', 'important');
        }
    };
    
</script>
@endsection
