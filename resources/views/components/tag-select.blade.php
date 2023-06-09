@props(['options'=> []])
<div class="bg-grey-lighter">
    <div x-data="{
               tags: [],
               newTag: '',
               inputName: 'foo',
               show: false,
               services: {!! $options !!},
               addTag(service, tags) {
                    console.log(service, tags)
                    if (!tags.includes(service)) {
                        tags.push(service);
                    }
                },
                positionCloud(){
                tagCloud = document.querySelector('#tag-cloud');
                wrapper = document.querySelector('#wrapper');
                var newHeight = wrapper.offsetHeight + 2;
                tagCloud.style.top = newHeight.toString() + 'px';
                },
                addService(service, services) {
                    services.push(service);
                }
               }"
         style="position:relative;"
         id="wrapper"
    >

        <template x-for="tag in tags">
            <input type="hidden" x-bind:name="inputName + '[]'" x-bind:value="tag">
        </template>

        <div class="max-w-sm w-full mx-auto">
            <div class="tags-input" >
                <div style="display:flex;flex-wrap:wrap;padding:0.25em;">
                    <template x-for="tag in tags" :key="tag">
                    <span class="tags-input-tag">
                      <span x-text="tag"></span>
                      <button type="button" class="tags-input-remove"
                              @click="tags = tags.filter(i => i !== tag);show=false;addService(`${tag}`, services)">
                        &times;
                      </button>
                    </span>
                    </template>

                    <input class="tags-input-text" placeholder="{{ __('Select Services') }}..." x-model="newTag"
                           x-on:focus="show=true;positionCloud()"
                           x-on:keydown.escape="show=false;"
                    >
                </div>
                <span id="tag-cloud" class="list-group" x-show="show">
                  <template
                      x-for="service in services"
                      :key="service">
                    <span class="tags-input-tag"
                          x-on:click="services = services.filter(i => i !== service);addTag(`${service.id}`, tags);newTag='';show=false;">
                      <div :x-ref="service" class="w-full hover:bg-gray-300" x-text="service.name"></div>
                    </span>
                  </template>
              </span>
            </div>

        </div>
    </div>
</div>

@push('styles')
    <style>
        .tags-input {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            background-color: #fff;
            border-width: 1px;
            /*padding-left: .5rem;*/
            /*padding-right: 1rem;*/
            /*padding-top: .5rem;*/
            /*padding-bottom: .25rem;*/
        }

        .tags-input-tag {
            display: inline-flex;
            line-height: 1;
            align-items: center;
            font-size: .875rem;
            background-color: #bcdefa;
            color: #1c3d5a;
            user-select: none;
            padding: .5rem;
            margin-right: .5rem;
            margin-bottom: .25rem;
            cursor: pointer;
        }

        .list-group{
            list-style-type: none; /* Remove bullets */
            /* Remove padding */
            margin: 0; /* Remove margins */
            padding: 1.5rem 1.5rem 1.5rem 1.5rem;
            display: flex;
            top: 50px;
            box-shadow: 3px 4px 4px #ccc;
            border: 1px solid #eee;
            width: 600px;
            flex-wrap: wrap;
            background-color: #fff;
            z-index: 99;
            position:absolute;
        }

        .tags-input-tag:last-of-type {
            margin-right: 0;
        }

        .tags-input-remove {
            color: #2779bd;
            font-size: 1.125rem;
            line-height: 1;
        }

        .tags-input-remove:first-child {
            margin-right: .25rem;
        }

        .tags-input-remove:last-child {
            margin-left: .25rem;
        }

        .tags-input-remove:focus {
            outline: 0;
        }

        .tags-input-text {
            flex: 1;
            outline: 0;
            /*border: 1px solid #ddd;*/
            padding: 10px;
            margin-left: .5rem;
            /*margin-bottom: .25rem;*/
            background-color: #fff;
            min-width: 10rem;
        }

    </style>
    @endpush
