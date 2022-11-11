@php use App\Models\StudySheet; @endphp
<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto h-full">
        <div>
            <div class="md:-mx-4">
                <div class="mt-5 md:mt-0 md:px-4 w-full md:w-1/2 mx-auto space-y-2">
                    <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                        {{ __('Study Sheet') }}</h2>
                    <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                        {{ __('This information will be shared with staff members of the Nordakademie. Please check the information for accuracy.') }}
                    </p>
                </div>
                <div class="mt-8 md:px-4 w-full md:w-1/2 mx-auto">
                    @if (!$studySheet->is_submit)
                        <form wire:submit.prevent="submit" id="courseForm">
                            <div class="space-y-10">
                                <div class="space-y-4">
                                    {{--<div>
                                        <x-jet-label for="is_active" class="block required">{{ __('Tuition payment') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active" model="studySheet.payment"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Please select') }}</option>
                                            <option value="1">
                                                {{ __('I would like to take advantage of the option of paying in four installments at the beginning of each semester') }}
                                            </option>
                                            <option value="2">
                                                {{ __('I would like to receive an invoice for the total amount at the beginning of the studies') }}
                                            </option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="studySheet.payment"/>
                                    </div>--}}
                                    <div>
                                        <x-jet-label for="is_active" class="block required">{{ __('Billing address') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="studySheet.billing_address"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Please select') }}</option>
                                            <option value="1">
                                                {{ __('Invoice(s) for tuition and fees should be mailed to the address on the application form') }}
                                            </option>
                                            <option value="2">
                                                {{ __('The invoice(s) for the tuition fees should be sent to a different address') }}
                                            </option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="studySheet.billing_address"/>
                                    </div>
                                    @if ($studySheet->billing_address == StudySheet::ADDRESS_CUSTOM_ADDRESS)
                                        <div>
                                            <x-jet-label for="name" class="block">{{ __('Name/Company') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter Name/Company')"
                                                         wire:model="studySheet.custom_billing_address.name"
                                                         id="custom_billing_address_name"></x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_billing_address.name"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">
                                                {{ __('Street and house number') }}</x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter street and house number')"
                                                         wire:model.lazy="studySheet.custom_billing_address.address"
                                                         id="custom_billing_address_address">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_billing_address.address"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block">{{ __('Address Suffix') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter address suffix')"
                                                         wire:model.lazy="studySheet.custom_billing_address.address_suffix"
                                                         id="custom_billing_address_ddress_suffix"></x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_billing_address.address_suffix"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">{{ __('Postal code') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter postal code')"
                                                         wire:model.lazy="studySheet.custom_billing_address.postal_code"
                                                         id="custom_billing_address_postal_code">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_billing_address.postal_code"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">{{ __('Location') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text" :placeholder="__('Enter location')"
                                                         wire:model.lazy="studySheet.custom_billing_address.location"
                                                         id="custom_billing_address_location">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_billing_address.location"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">{{ __('Country') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text" :placeholder="__('Enter country')"
                                                         wire:model.lazy="studySheet.custom_billing_address.country"
                                                         id="custom_billing_address_country">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_billing_address.country"/>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="italic mb-4 justify-end">
                                            {{ __('study sheet paragraph 1') }}
                                        </p>
                                        <p class="italic justify-end">
                                            {{ __('study sheet paragraph 2') }}
                                        </p>
                                    </div>

                                    {{--<div>
                                        <x-jet-label for="is_active" class="block required">{{ __('Delivery address') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="studySheet.delivery_address"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Please select') }}</option>
                                            <option value="1">
                                                {{ __('All study materials (study folders, books) should be sent to the address on the application form') }}
                                            </option>
                                            <option value="2">
                                                {{ __('All study materials (study folders, books) should be sent to a different address') }}
                                            </option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="studySheet.delivery_address"/>
                                    </div>
                                    @if ($studySheet->delivery_address == \App\Models\StudySheet::ADDRESS_CUSTOM_ADDRESS)
                                        <div>
                                            <x-jet-label for="name" class="block">{{ __('Name/Company') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter Name/Company')"
                                                         wire:model.lazy="studySheet.custom_delivery_address.name"
                                                         id="custom_delivery_address_name"></x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_delivery_address.name"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">
                                                {{ __('Street and house number') }}</x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter street and house number')"
                                                         wire:model.lazy="studySheet.custom_delivery_address.address"
                                                         id="custom_delivery_address_address">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_delivery_address.address"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block">{{ __('Address Suffix') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter address suffix')"
                                                         wire:model.lazy="studySheet.custom_delivery_address.address_suffix"
                                                         id="custom_delivery_address_address_suffix"></x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_delivery_address.address_suffix"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">{{ __('Postal code') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter postal code')"
                                                         wire:model.lazy="studySheet.custom_delivery_address.postal_code"
                                                         id="custom_delivery_address_postal_code">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_delivery_address.postal_code"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">{{ __('Location') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text" :placeholder="__('Enter location')"
                                                         wire:model.lazy="studySheet.custom_delivery_address.location"
                                                         id="custom_delivery_address_location">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_delivery_address.location"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block required">{{ __('Country') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text" :placeholder="__('Enter country')"
                                                         wire:model.lazy="studySheet.custom_delivery_address.country"
                                                         id="custom_delivery_address_country">
                                            </x-jet-input>
                                            <x-jet-input-error for="studySheet.custom_delivery_address.country"/>
                                        </div>
                                    @endif--}}

                                    <div>
                                        <x-jet-label for="health_insurance_type" class="block required">
                                            {{ __('Health insurance type') }}
                                        </x-jet-label>
                                        <x-livewire-select id="health_insurance_type" name="health_insurance_type"
                                                           model="studySheet.health_insurance_type"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Please select') }}</option>
                                            <option value="1"> {{ __('Legal') }} </option>
                                            <option value="2"> {{ __('Private') }} </option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="studySheet.health_insurance_type"/>
                                    </div>

                                    @if ($studySheet->health_insurance_type == StudySheet::HEALTH_INSURANCE_LEGAL)
                                        <div>
                                            <x-jet-label for="name" class="block required">
                                                {{ __('Health insurance number') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter health insurance number')"
                                                         wire:model.lazy="studySheet.health_insurance_number"
                                                         id="health_insurance_number_name" min="10"
                                                         max="10"></x-jet-input>
                                            <x-jet-input-error for="studySheet.health_insurance_number"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="is_active" class="block required">
                                                {{ __('Health insurance') }}
                                            </x-jet-label>
                                            <x-livewire-select id="is_active" name="is_active"
                                                               model="studySheet.health_insurance_company_id"
                                                               class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value=""> {{ __('Please select') }}</option>
                                                @foreach ($this->healthInsuranceCompanies as $healthInsuranceCompany)
                                                    <option value="{{ $healthInsuranceCompany->id }}">
                                                        {{ $healthInsuranceCompany->short_description }}
                                                    </option>
                                                @endforeach
                                            </x-livewire-select>
                                            <x-jet-input-error for="studySheet.health_insurance_company_id"/>
                                        </div>
                                        @if ($studySheet->health_insurance_company_id == StudySheet::HEALTH_INSURANCE_OTHER)
                                            <div>
                                                <x-jet-label for="name" class="block required">
                                                    {{ __('Health insurance') }}
                                                </x-jet-label>
                                                <x-jet-input class="w-full" type="text"
                                                             :placeholder="__('Enter health insurance')"
                                                             wire:model.lazy="studySheet.health_insurance_company"
                                                             id="health_insurance_company_name"></x-jet-input>
                                                <x-jet-input-error for="studySheet.health_insurance_company"/>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                @if(!$paymentOptionDisabled)
                                    <div class="space-y-4">
                                        <div>
                                            <h1 class="text-primary font-semibold text-base md:text-lg leading-tight">{{ __('SEPA direct debit mandate') }}</h1>
                                        </div>
                                        <div>
                                            <x-jet-label for="name"
                                                         class="block {{ $studySheet->billing_address != 1 ?: 'required' }}">
                                                {{ __('Account holder') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter account holder')"
                                                         wire:model.lazy="studySheet.account_holder"
                                                         id="account_holder_name"></x-jet-input>
                                            <x-jet-input-error for="studySheet.account_holder"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block {{ $studySheet->billing_address != 1 ?: 'required' }}">
                                                {{ __('IBAN') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text" :placeholder="__('Enter IBAN')"
                                                         wire:model.lazy="studySheet.iban"
                                                         id="iban_name"></x-jet-input>
                                            <x-jet-input-error for="studySheet.iban"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="name" class="block {{ $studySheet->billing_address != 1 ?: 'required' }}">
                                                {{ __('BIC – Swift-Code') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full" type="text"
                                                         :placeholder="__('Enter BIC – Swift-Code')"
                                                         wire:model.lazy="studySheet.swift_code"
                                                         id="swift_code_name"></x-jet-input>
                                            <x-jet-input-error for="studySheet.swift_code"/>
                                        </div>
                                    </div>
                                @endif
                                <div class="">
                                    <div class="flex form-check flex space-x-4">
                                        <input wire:model.lazy="studySheet.is_authorize"
                                               class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                                               type="checkbox">
                                        <label class="form-check-label inline-block text-gray-800">
                                            {{ __('study sheet is authorize') }}
                                        </label>
                                    </div>
                                    <x-jet-input-error for="studySheet.is_authorize"/>
                                </div>

                                <div class="mb-7">
                                    <div class="flex form-check flex space-x-4">
                                        <input wire:model.lazy="studySheet.privacy_policy"
                                               class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                                               type="checkbox">
                                        <label class="form-check-label inline-block text-gray-800">
                                            {{ __('study sheet privacy policy') }}
                                        </label>
                                    </div>
                                    <x-jet-input-error for="studySheet.privacy_policy"/>
                                </div>
                            </div>
                            <div class="py-3 text-right">
                                <x-primary-button type="submit" class="">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <div>
                            <p class="mt-2 text-darkblack">
                                {{ $formAlreadySubmitted ? __('Your form already submitted successfully.') : __('Your form submitted successfully.') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
