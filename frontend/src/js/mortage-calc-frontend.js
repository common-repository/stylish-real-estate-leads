const firstProperty = document.querySelector('.first-property');
var r = document.querySelector(':root');
var rs = getComputedStyle(r);
var primary_color ='#304af8';
var sec_color = '#000';
var sec_color = '#000';
var title_and_text_color = '#000000';
primary_color = srel_options['primary_color'] != '#304af8' ? srel_options['primary_color'] : '#304af8';
sec_color = srel_options['sec_color'] != '#000' ? srel_options['sec_color']  : '#000';
title_and_text_color = srel_options['title_and_text_color'] != '#000000' ? srel_options['title_and_text_color']  : '#000000';
r.style.setProperty('--mortgage-calculator-main-color', primary_color);
r.style.setProperty('--mortgage-calculator-sec-color', sec_color);
r.style.setProperty('--mortgage-calculator-main-color-op', (primary_color + '10'));
r.style.setProperty('--mortgage-calculator-sec-color-half-active', (primary_color + '84'));
r.style.setProperty('--mortgage-calculator-sec-color-op', (sec_color + 60));
r.style.setProperty('--mortgage-calculator-title-text-color', title_and_text_color);
var contentTabButtonChild = ".srel-tab-button-child";
var contentChild = ".content-child";
const compareBtn = document.querySelector('.btn-compare');
compareBtn.addEventListener('click', () => {
  const currentInstanceId = Number(compareBtn.getAttribute('data-instance-id'));
  const currentInstanceSelector = 'i' + Number(currentInstanceId);
  const lastCalcForm = currentInstanceId == 1 ? firstProperty : document.querySelector(`.compared-property-${currentInstanceId - 1}`);
  var tab_btn = `<button class="srel-tab-button"  data-id="compared-property-${currentInstanceId}" data-instance-id="${currentInstanceId}">Compared Property</button>`
  document.querySelector('.srel-property-tabs').innerHTML += tab_btn;
  const newForm = htmlStringToElement(String.raw`<div id="compared-property-${currentInstanceId}" class="compared-property-${currentInstanceId} compared content">${firstProperty.innerHTML}</div>`);
  [...newForm.querySelectorAll(['label'])].forEach(e => {
    e.setAttribute('for', `${currentInstanceSelector}-` + e.getAttribute('for'));
    e.classList.remove('active');
  });
  [...newForm.querySelectorAll(['input'])].forEach(e => {e.setAttribute('id', `${currentInstanceSelector}-` + e.getAttribute('id'))});
  [...newForm.querySelectorAll([`${contentTabButtonChild}`])].forEach(e => {e.setAttribute('data-id', e.getAttribute('data-title')+`-${currentInstanceSelector}` );
    var data_id_step = currentInstanceId == 0 ? "first-property" : `compared-property-${currentInstanceId}`;
    e.setAttribute("data-id-step",data_id_step);
  });
  [...newForm.querySelectorAll(['.progressbar li'])].forEach((e,index) => {
    if (index > 0)
    {
      e.classList.remove('active');
    }
  });
  newForm.querySelector(`.progressbar`).setAttribute('data-parent', `compared-property-${currentInstanceId}`);
  newForm.querySelector(`.next-btn`).classList.remove('d-none');
  newForm.querySelector(`.next-btn`).setAttribute('step',1);
  newForm.querySelector(`.next-btn`).setAttribute('data-parent', `compared-property-${currentInstanceId}`);
  var nextBtn = newForm.querySelector(`.next-btn`);
  nextBtn.addEventListener('click', () => {
    nextStep(nextBtn);
  });
  newForm.querySelector(`.calc-btn`).classList.add('d-none');
  [...newForm.querySelectorAll([`${contentChild}`])].forEach(e => {e.setAttribute('id', e.getAttribute('data-title')+`-${currentInstanceSelector}` )});
  compareBtn.setAttribute('data-instance-id', Number(currentInstanceId) + 1)
  lastCalcForm.after(newForm);
  let newCalcFormNode = document.querySelector(`.compared-property-${currentInstanceId}`);
  // newForm.appendChild(firstPropertyFields);
  const instanceTwo = new CalculationForm(newCalcFormNode, true, `${currentInstanceSelector}-`, currentInstanceId);
  instanceTwo.applyCalc();
  //compareBtn.classList.add('srl-d-none');
  document.querySelector("#compared-property-"+currentInstanceId).classList.remove("active");
});
var tabButtonSelector
function htmlStringToElement(html) {
  var template = document.createElement('template');
  html = html.trim(); // Never return a text node of whitespace as the result
  template.innerHTML = html;
  return template.content;
}
var nextBtn = document.querySelector(`.next-btn`);
nextBtn.addEventListener('click', () => {
  nextStep(nextBtn);
});
const sendMeACopyForm = (prefix = '1') => {
  let additionalHTML = '';
  if (typeof srel_options['phone_number']!== 'undefined' && srel_options['phone_number'] == '1') {
    additionalHTML += `<div class="srl-input-group">
        <div class="input-field-wrapper is-flex">
            <label for="${prefix}-result-send-a-copy-phone">Phone</label>
            <input type="text" name="phone" id="${prefix}-result-send-a-copy-phone" class="phone" minlength="6" pattern="[0-9\\-]*" maxlength="20" required title="Please enter numbers only" oninvalid="this.setCustomValidity('Please enter numbers only')" oninput="this.setCustomValidity('')">
        </div>
      </div>`;
  }
  if (typeof srel_options['comment_box'] !== 'undefined' && srel_options['comment_box'] == '1') {
    additionalHTML += `<div class="srl-input-group">
        <div class="input-field-wrapper is-flex">
            <label for="${prefix}-result-send-a-copy-comment">Comment</label>
            <textarea  type="text" name="comment" id="${prefix}-result-send-a-copy-comment"></textarea>
        </div>
      </div>`;
  }
  return `

   <div class="srel-popup">
<p style="text-align: justify">Submit your email to receive your personalized results via email. We'll compile your data and create an <b>easy-to-digest PDF table</b>, featuring cash flow, net operating income, and additional insights to help you better understand the property's potential.</p><form id="collect-lead">
       <div class="input-wrapper">
      <div class="srl-input-group">
        <div class="input-field-wrapper is-flex">
            <label for="${prefix}-result-send-a-copy-firstname">First Name</label>
            <input type="text" name="firstname" id="${prefix}-result-send-a-copy-name" required>
        </div>
        <div class="input-field-wrapper is-flex">
            <label for="${prefix}-result-send-a-copy-lastname">Last Name</label>
            <input type="text" name="lastname" id="${prefix}-result-send-a-copy-lastname" required>
        </div>
      </div>
      <div class="srl-input-group">
        <div class="input-field-wrapper is-flex">
            <label for="${prefix}-result-send-a-copy-email">Your Email</label>
            <input type="email" name="email" id="${prefix}-result-send-a-copy-email" required>
        </div>
      </div>
      ${additionalHTML}
      <button class="btn-result calc-btn">Get My Results</button>
    </div>
</div>
  </form>`
}

const formDataToJson = (data) => {
  let dataObject = {};
  [...data].forEach(e => {dataObject[e[0]] = e[1];});
  return dataObject;
}

const getPropertyCashFlow = (wrapper) => {
  let dataObject = {};
  wrapper.querySelectorAll('[data-row-info]').forEach(e => {
    dataObject[e.getAttribute('data-row-info')] = {
      monthly: e.children[1].textContent,
      yearly: e.children[2].textContent,
      x_years: e.children[3].textContent
    }
  });
  return dataObject;
}

const handleInputFieldInteraction = inputWrapper => {
  inputWrapper.addEventListener('focus', (e) => {
    if ( e.target.tagName == 'INPUT' ) {
      e.target.parentElement.querySelector('label')?.classList.add('active');
    }
  }, true)
  inputWrapper.addEventListener('input', (e) => {
    if ( e.target.tagName == 'INPUT' ) {
      e.target.parentElement.querySelector('label')?.classList.add('active');
    }
  }, true)
  inputWrapper.addEventListener(
      'blur', function (e) {
        if ( e.target.tagName == 'INPUT' && e.target.value.length <= 0 ) {
          e.target.parentElement.querySelector('label')?.classList.remove('active');
        }
      }, true);
}
function nextStep(nextBtn)
{
  var parent = nextBtn.getAttribute('data-parent');
  var step = parseInt(nextBtn.getAttribute('step'));
  const wrapper = document.querySelector(`.${parent} .srl-input-section[data-section-id='${step}']`);
  var requiredInputs = [...wrapper.querySelectorAll('input[required]')];
  var isFormValid = true;

  requiredInputs.forEach(input => {
    if (input.value === '') {
      let fieldWrapper = input.parentElement.parentElement;
      fieldWrapper.querySelector('.srl-warning').classList.remove('srl-d-none');
      isFormValid = false;
      nextBtn.setAttribute('aria-label', 'Fill mandatory fields in order to proceed.')
      nextBtn.setAttribute('data-balloon-length', 'medium');
      nextBtn.setAttribute('data-balloon-pos', 'right');
    } else {
      let fieldWrapper = input.parentElement.parentElement;
      fieldWrapper.querySelector('.srl-warning').classList.add('srl-d-none');
    }
  });

  if (isFormValid) {
    nextBtn.removeAttribute('aria-label');
    nextBtn.removeAttribute('data-balloon-length');
    nextBtn.removeAttribute('data-balloon-pos');
    document.querySelector(`.${parent} ${contentTabButtonChild}:nth-child(${step + 1})`).click();
  }
}
function formatPropertyName(propertyName) {
  // replace hyphens with spaces
  let formattedPropertyName = propertyName.replace(/-/g, ' ');

  // capitalize the first letter of each word
  formattedPropertyName = formattedPropertyName.replace(/\b\w/g, function(match) {
    return match.toUpperCase();
  });

  return formattedPropertyName;
}
class CalculationForm {
  constructor(wrapper, createResultBox = false, prefix = '', instanceId = 0) {
    this.wrapper = wrapper;
    if (! createResultBox) {
      this.resultBox = mainResultBox;
    }
    if (createResultBox) {
      let lastResultBox = instanceId <= 1 ? mainResultBox : document.querySelector(`[data-form-for=${'i' + (instanceId -1) + '-'}]`);
      // lastResultBox.querySelector('.results-content').setAttribute('data-form-id','first-property');
      const resultBoxTemplateHTML = htmlStringToElement(resultBoxTemplate);
      resultBoxTemplateHTML.querySelector('.results-content').classList.remove("active");
      resultBoxTemplateHTML.querySelector('.results-content').setAttribute('data-form-id','compared-property-'+instanceId);
      lastResultBox.after(resultBoxTemplateHTML);
      this.resultBox = lastResultBox.nextElementSibling;
      // this.resultBox.classList.add('srl-mt-2');
      this.resultBox.setAttribute('data-form-for', prefix);
    }
    this.prefix = prefix;
  }

  applyCalc() {
    const fieldsWrapper = this.wrapper;
    const fieldPrefix = this.prefix;
    const calcBtn = this.wrapper.querySelector('.calc-btn.btn-result');
    const clearBtn = this.wrapper.querySelector('.btn-clear-form');

    const currentInstanceId = compareBtn.getAttribute('data-instance-id');

    if (! currentInstanceId ) {
      compareBtn.setAttribute('data-instance-id', 1);
    }

    if (currentInstanceId) {
      compareBtn.classList.remove('srl-d-none');
    }

    // defining input fields

    let houseAddr = this.wrapper.querySelector('#' + this.prefix + 'h_address');
    let years = this.wrapper.querySelector('#' + this.prefix + 'years');
    let housePrice = this.wrapper.querySelector('#' + this.prefix + 'purchase_price');
    let downPayment = this.wrapper.querySelector('#' + this.prefix + 'down_payment');
    let interestRate = this.wrapper.querySelector('#' + this.prefix + 'interest');
    let incomeInput = this.wrapper.querySelector('#' + this.prefix + 'monthly_rent');
    let vacancyInput = this.wrapper.querySelector('#' + this.prefix + 'vacancy_rate');
    let otherIncomeInput = this.wrapper.querySelector('#' + this.prefix + 'other_monthly_income');
    let managementFeeInput = this.wrapper.querySelector('#' + this.prefix + 'management_fee')
    let propertyTaxInput = this.wrapper.querySelector('#' + this.prefix + 'property_tax')
    let totalInsuranceInput = this.wrapper.querySelector('#' + this.prefix + 'total_insurance')
    let hoaFeeInput = this.wrapper.querySelector('#' + this.prefix + 'hoa_fee')
    let maintenanceCostInput = this.wrapper.querySelector('#' + this.prefix + 'maintenance_cost')
    let otherCostInput = this.wrapper.querySelector('#' + this.prefix + 'other_costs')
    let valueAppreciationInput = this.wrapper.querySelector('#' + this.prefix + 'value_appreciation')
    let holdingLengthInput = this.wrapper.querySelector('#' + this.prefix + 'holding_length')
    let costToSellInput = this.wrapper.querySelector('#' + this.prefix + 'cost_to_sell')
    let closingCostInput = this.wrapper.querySelector('#' + this.prefix + 'closing_cost')
    let annualRentIncreaseInput = this.wrapper.querySelector('#' + this.prefix + 'annual_rent_increase')
    let annualExpenseIncreaseInput = this.wrapper.querySelector('#' + this.prefix + 'annual_expense_increase')
    const tooltip = document.querySelector("#tooltip");

    // tooltip init
    // createPopper(housePrice, tooltip, {
    //   placement: 'top',
    // });

    function getInputFieldValue(field) {
      if (field.required && field.value.length <= 0) {
        let fieldWrapper = field.parentElement.parentElement;
        fieldWrapper.querySelector('.srl-warning').classList.remove('srl-d-none');
      }
      if (field.hasAttribute('data-numeric-input')) {
        field.value = returnCommaValue(field.value);
        return removeCommas(field.value);
      }
      return field.value;
    }
    function getRating(cash_flow)
    {
      var rating;
      if (cash_flow >= 1000) {
        rating = "A";
      }
      else if (cash_flow >= 500 && cash_flow <= 999)
      {
        rating = "B";
      }
      else if (cash_flow >= 100 && cash_flow <= 499)
      {
        rating = "C";
      }
      else if (cash_flow >= -100 && cash_flow <= -500)
      {
        rating = "D";
      }
      else if (cash_flow <= -500)
      {
        rating = "F";
      }
      else {
        rating = "F";
      }
      return rating;
    }
    // defining result rows and send me a copy button

    let mortgagePayRow = this.resultBox.querySelector('[data-row-info=mortgage-pay]');
    let incomeRow = this.resultBox.querySelector('[data-row-info=income]');
    let vacancyRow = this.resultBox.querySelector('[data-row-info=vacancy]');
    let propertyTaxRow = this.resultBox.querySelector('[data-row-info="property-tax"]');
    let totalInsuranceRow = this.resultBox.querySelector('[data-row-info="total-insurance"]');
    let maintenanceCostRow = this.resultBox.querySelector('[data-row-info="maintenance-cost"]');
    let otherCostRow = this.resultBox.querySelector('[data-row-info="other-cost"]');
    let hoaFeeRow = this.resultBox.querySelector('[data-row-info="hoa-fee"]');
    let cashFlowRow = this.resultBox.querySelector('[data-row-info="cash-flow"]');
    let noiRow = this.resultBox.querySelector('[data-row-info="noi"]');
    let capRateRow = this.resultBox.querySelector('[data-row-info="caprate"]');
    let sellingPriceRow = this.resultBox.querySelector('[data-row-info="sellingprice"]');
    let totalProfitRow = this.resultBox.querySelector('[data-row-info="totalprofit"]');
    let managementFeeRow = this.resultBox.querySelector('[data-row-info="management-fee"]');
    let ctaBtn = this.resultBox.querySelector('.cta-btn');
    let resultTitle = this.resultBox.querySelector('[data-result-title]');
    let housePriceDisplay = this.resultBox.querySelector('.srl-h-price');
    let numYearsText = this.resultBox.querySelector('.srl-year-text');
    let ratingElement = this.resultBox.querySelector('[data-row-rating=rating]');
    let ratingParent = this.resultBox.querySelector('.srl-h-rating');
    // show of hide rating
    if (typeof srel_options['rating_show_frontend'] !== 'undefined' && srel_options['rating_show_frontend'] == '1') {
      ratingParent.classList.remove('srl-d-none');
    }
    // attaching event handlers to input fields, buttons etc.

    houseAddr.addEventListener('keyup', (evt) => {
      resultTitle.textContent = evt.target.value;
      resultTitle.classList.remove('srl-d-none');
      mainTabBox.querySelector(".srel-tab-button.active").textContent = evt.target.value;
    })

    housePrice.addEventListener('keyup', evt => {
      housePriceDisplay.textContent = '$' + evt.target.value;
      housePriceDisplay.classList.remove('srl-d-none');
    })

    years.addEventListener('change', evt => {
      holdingLengthInput.value = evt.target.value;
      if (holdingLengthInput.value.length > 0) {
        holdingLengthInput.previousElementSibling.classList.add('active');
      } else {
        holdingLengthInput.previousElementSibling.classList.remove('active');
      }
    })

    calcBtn.addEventListener('click', () => {
      calculate();
    });
    clearBtn.addEventListener('click', () => {
      applyInputValues({
        'purchase_price':0,
        'closing_cost': 0,
        'down_payment': 0,
        'interest': 0,
        'years': 0,
        'monthly_rent': '',
        'vacancy_rate': '',
        'other_monthly_income': '',
        'management_fee': '',
        'property_tax': '',
        'total_insurance': '',
        'hoa_fee': '',
        'maintenance_cost': '',
        'other_costs': '',
        'value_appreciation': '',
        'holding_length': '',
        'cost_to_sell': '',
        'h_address':''
      });
    });
    [...document.querySelectorAll('.progressbar')].forEach(function(item) {
      var parent = item.getAttribute("data-parent");
      [...document.querySelectorAll(`.${parent} .progressbar li`)].forEach(function(item2,index) {
        item2?.addEventListener('click', (e) => {
          document.querySelector(`.${parent} .srel-tab-button-child:nth-child(${index+1})`).click()
        })
      });
    });
    [...document.querySelectorAll('.srel-calculator .srel-tab-button')].forEach(function(item, index) {
      const tabButton = document.querySelectorAll(".srel-calculator .srel-tab-button");
      const contents = document.querySelectorAll(".srel-calculator .content");
      var parent = item.getAttribute('data-id');
      var nextBtn = document.querySelector(`.${parent} .next-btn`);
      var calcBtn = document.querySelector(`.${parent} .calc-btn`);
      item?.addEventListener('click', (e) => {
        const id = e.target.dataset.id;
        if (id) {
          tabButton.forEach(btn => {
            btn.classList.remove("active");
          });
          e.target.classList.add("active");
          contents.forEach(content => {
            content.classList.remove("active");
          });
          const element = document.getElementById(id);
          element.classList.add("active");
        }
        var parent = item.getAttribute('data-id');
        [...document.querySelectorAll(`.${parent} ${contentChild}`)].forEach(function(item,index) {
          if (index == 0)
          {
            item.classList.add("active");
          }
          else
          {
            item.classList.remove("active");
          }
        });
        [...document.querySelectorAll(`.${parent} ${contentTabButtonChild}`)].forEach(function(item,index) {
          if (index == 0)
          {
            item.classList.add("active");
          }
          else
          {
            item.classList.remove("active");
          }

        });
        [...document.querySelectorAll(`.${parent} .progressbar li`)].forEach(function(item,index) {
          if (index == 0)
          {
            item.classList.add("active");
          }
          else if (index == 1)
          {
            item.classList.remove("active");
            item.classList.add("half-active");
          }
          else
          {
            item.classList.remove("half-active")
            item.classList.remove("active");
          }
        });
        [...document.querySelectorAll('.results-container .results-content')].forEach(function (item_result){
          item_result.classList.remove("active");
          if (item.getAttribute('data-id') ==  item_result.getAttribute('data-form-id')){
            item_result.classList.add("active");
          }
        });
        nextBtn.classList.remove('d-none')
        nextBtn.setAttribute('step',1);
        calcBtn.classList.add('d-none');
      })
    });
    [...document.querySelectorAll(`${contentTabButtonChild}`)].forEach(function(item,index) {
      var parent = item.getAttribute('data-id-step');
      const tabButtonChild = document.querySelectorAll(`.${parent} ${contentTabButtonChild}`);
      const contentsChild = document.querySelectorAll( `.${parent} ${contentChild}`);
      var nextBtn = document.querySelector(`.${parent} .next-btn`);
      var calcBtn = document.querySelector(`.${parent} .calc-btn`);
      [...document.querySelectorAll(`.${parent} ${contentTabButtonChild}`)].forEach(function(item,index) {
        item?.addEventListener('click', (e) => {
          const id = e.target.dataset.id;
          if (id) {
            tabButtonChild.forEach(btn => {
              btn.classList.remove("active");
            });
            e.target.classList.add("active");
            contentsChild.forEach(content => {
              content.classList.remove("active");
            });
            const element = document.getElementById(id);
            element.classList.add("active");
            var parent = item.getAttribute('data-id-step');
            var step = item.getAttribute('data-step');
            var progressBarItems = document.querySelectorAll(`.${parent} .progressbar li`);
            progressBarItems.forEach(function(item, index) {
              item.classList.remove("active");
              item.classList.remove("half-active");
              if (index < parseInt(step)) {
                item.classList.add("active");
              } else if (index === parseInt(step)) {
                item.classList.add("half-active");
              }
            });
            if (index === tabButtonChild.length - 1)
            {
              nextBtn.classList.add('d-none')
              calcBtn.classList.remove('d-none');
            }
            else
            {
              nextBtn.classList.remove('d-none')
              calcBtn.classList.add('d-none');
            }
            nextBtn.setAttribute('step', item.getAttribute('data-step'));
          }
        })
      });
    });
    this.wrapper.querySelectorAll('.input-wrapper').forEach(handleInputFieldInteraction);

    const sections = this.wrapper.querySelectorAll('[data-section-id]');
    [...sections].forEach(element => {
      let showTargets = element.querySelectorAll('[data-optional-input]')
      element.querySelector('.more-opts')?.addEventListener('click', evt => {
        evt.target.classList.add('srl-d-none');
        [...showTargets].forEach(element1 => {
          element1.classList.remove('srl-d-none');
        })
      })
    });

    // let availableInputs = [...this.wrapper.querySelectorAll('input')].map(e => e.getAttribute('id'));
    function applyInputValues (inputValues = null) {
      // if (inputValues == null) {
      //   inputValues = [{'purchase_price': 100000}, {'closing_cost': 3000}, {'down_payment': 30}, {'interest': 4.5}, {'years': 30}, {'monthly_rent': 1000}, {'vacancy_rate': 5}, {'other_monthly_income': 1000}, {'management_fee': 1000}, {'property_tax': 1000}, {'total_insurance': 1000}, {'hoa_fee': 100}, {'maintenance_cost': 1000}, {'other_costs': 1000}, {'value_appreciation': 3}, {'holding_length': 20}, {'cost_to_sell': 2.5}]
      // }
      if (inputValues == null) {
        inputValues = {
          'purchase_price': 100000,
          'closing_cost': 3000,
          'down_payment': 20,
          'interest': 2.5,
          'years': 30,
          'monthly_rent': 1000,
          'vacancy_rate': 5,
          'other_monthly_income': 0,
          'management_fee': 1000,
          'property_tax': 1500,
          'total_insurance': 800,
          'hoa_fee': 0,
          'maintenance_cost': 1000,
          'other_costs': 200,
          'value_appreciation': 3,
          'holding_length': 20,
          'cost_to_sell': 8,
        }
      }
      [...fieldsWrapper.querySelectorAll('.srl-warning')].forEach(e => {
        e.classList.add('srl-d-none');
      });

      Object.keys(inputValues).forEach((field, index) => {
        let targetInputId = fieldPrefix + field;
        let targetInput = fieldsWrapper.querySelector('#' + targetInputId);
        let targetInputLabel = fieldsWrapper.querySelector(`[for=${targetInputId}]`);
        if (targetInput.hasAttribute('data-numeric-input')) {
          if (inputValues[field] !== undefined && inputValues[field] !== null && !isNaN(inputValues[field])) {
            inputValues[field] = inputValues[field];
          } else {
            inputValues[field] = 0;
          }
          targetInput.value = removeCommas(String(inputValues[field]));
        }
        if (! targetInput.hasAttribute('data-numeric-input')) {
          targetInput.value = inputValues[field];
        }
        // if (targetInput.value != '')
        // {
        //   targetInputLabel.classList.add('active');
        // }
        if (index == Object.keys(inputValues).length - 1) {
          calculate();
        }
      })
    }
    // applyInputValues();

    function printValueInResultBox(element, monthlyColumn, yearlyColumn, yearlyColumnTimesTheNumberOfYears) {
      console.log(monthlyColumn);
      const hasBadValue = isNaN(monthlyColumn) || isNaN(yearlyColumn) || isNaN(yearlyColumnTimesTheNumberOfYears);
      const loanTerm = document.getElementById("years").value
      if (hasBadValue) {
        element.querySelector('.srl-div-table-col:nth-child(2)').textContent = 'N/A';
        element.querySelector('.srl-div-table-col:nth-child(3)').textContent = 'N/A';
        element.querySelector('.srl-div-table-col:nth-child(4)').textContent = 'N/A';
        return;
      }
      const array_percentage = ["caprate"];
      const array_dollars = ["sellingprice", "totalprofit"];
      if (array_percentage.includes(element.getAttribute('data-row-info')))
      {
        element.querySelector('.srl-div-table-col:nth-child(4)').textContent = commaNumber(yearlyColumnTimesTheNumberOfYears.toFixed(0)) + "%";
      }
      else if (array_dollars.includes(element.getAttribute('data-row-info')))
      {
        element.querySelector('.srl-div-table-col:nth-child(4)').textContent ='$' + commaNumber(yearlyColumnTimesTheNumberOfYears.toFixed(0));
      }
      else
      {
        element.querySelector('.srl-div-table-col:nth-child(2)').textContent = '$' + commaNumber(monthlyColumn.toFixed(0));
        element.querySelector('.srl-div-table-col:nth-child(3)').textContent = '$' + commaNumber(yearlyColumn.toFixed(0));
        element.querySelector('.srl-div-table-col:nth-child(4)').textContent = '$' + commaNumber(yearlyColumnTimesTheNumberOfYears.toFixed(0));
      }
      var title = element.querySelector('.srl-div-table-col:nth-child(1)').textContent;
      var loanYears = loanTerm + " Years ";
      element.querySelector('.srl-div-table-col:nth-child(1)').setAttribute("data-loan-year", loanYears);
      if (window.matchMedia('screen and (max-width: 768px)').matches) {
        element.querySelector('.srl-div-table-col:nth-child(4)').setAttribute("data-label", loanYears);
      }
    }
    function storeCFValueInResultBox(element, monthlyColumn, yearlyColumn) {
      element.setAttribute('data-monthly-cost', '$' + commaNumber(monthlyColumn.toFixed(0)));
      element.setAttribute('data-yearly-cost', '$' + commaNumber(yearlyColumn.toFixed(0)));
    }

    // adding event listeners to house price input field
    const handleBlur = (evt) => {

      if (getInputFieldValue(evt.target) <= 0) return;
      var interest_rate = typeof srel_options['interest_rate'] === 'undefined' ? 5 :srel_options['interest_rate'] ;
      var loan_term = typeof srel_options['loan_term'] === 'undefined' ? 25 :srel_options['loan_term'] ;
      var vacancy_rate = typeof srel_options['vacancy_rate'] === 'undefined' ? 5 :srel_options['vacancy_rate'] ;
      var cost_to_sell = typeof srel_options['cost_to_sell'] === 'undefined' ? 4 :srel_options['cost_to_sell']  ;
      var closing_cost = typeof srel_options['closing_cost'] === 'undefined' ? 2 : (srel_options['closing_cost'])  ;
      var property_tax = typeof srel_options['property_tax'] === 'undefined' ? 0.7 : (srel_options['property_tax'])  ;
      var insurance = typeof srel_options['insurance'] === 'undefined' ? 1 : (srel_options['insurance'])  ;
      var maintenance = typeof srel_options['maintenance'] === 'undefined' ? 0.5 : (srel_options['maintenance'])  ;
      var annual_rent_increase = (typeof srel_options['annual_rent_increase'] === 'undefined' || srel_options['annual_rent_increase'] == '' )? 2 : (srel_options['annual_rent_increase']) ;
      var annual_expense_increase = (typeof srel_options['annual_expense_increase'] === 'undefined' || srel_options['annual_expense_increase'] == '' )? 2 : (srel_options['annual_expense_increase']) ;
      const closingCost = (getInputFieldValue(evt.target) * (parseFloat(closing_cost)/100)).toFixed(2);
      const propertyTax = (getInputFieldValue(evt.target) * (parseFloat(property_tax)/100)).toFixed(2);
      const maintenanceCost = (getInputFieldValue(evt.target) * (parseFloat(maintenance)/100)).toFixed(2);
      const interestRate = (getInputFieldValue(evt.target) * (parseFloat(interest_rate)/100)).toFixed(2);
      const costToSell = (getInputFieldValue(evt.target) * (parseFloat(cost_to_sell)/100)).toFixed(2);
      const vacancyRate = (parseFloat(vacancy_rate)/100).toFixed(2);
      const insuranceFee = ((getInputFieldValue(evt.target)) * (parseFloat(insurance)/100)).toFixed(2);
      Swal.fire({
        title: 'Get Started Fast with Auto-Filled Data',
        html:
            `<div class="srel-popup">
               <p class="swal-desc">Would you prefer to have the following details automatically populated for you, based on average costs commonly associated with similar properties?</p>
            <p class="swal-desc" style="text-align: center;">Below is a pre-filled calculations and you can always change them after</p>
            <div class="alert-container">
            <table class="modal-table">
              <tbody>
                <tr>
                  <td>Interest Rate:</td>
                  <td>Loan Term:</td>
                </tr>
                <tr>
                 <td>`+interest_rate+`% annually</td>
                  <td>`+loan_term+` years</td>
                </tr>
                <tr>
                  <td>Closing Cost:</td>
                  <td>Vacancy Rate:</td>
                </tr>
                <tr>
                <td><strong>$${commaNumber(closingCost)}</strong></td>
                  <td>`+vacancy_rate+`%</td>
                </tr>
                <tr>
                  <td>Property Tax:</td>
                  <td>Maintenance:</td>
                </tr>
                <tr>
                 <td><strong>$${commaNumber(propertyTax)}</strong> (annually)</td>
                  <td><strong>$${commaNumber(maintenanceCost)}</strong> (annually) & `+maintenance+`% annual increase</td>
                </tr>
                <tr>
                  <td>Insurance:</td>
                  <td>Cost to Sell:</td>
                </tr>
                <tr>
                 <td><strong>$${commaNumber(insuranceFee)}</strong> (annually) & `+insurance+`% <br/>annual increase</td>
                  <td>`+cost_to_sell+`% annually</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>`,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Accept Pre-Filled Calculations',
        cancelButtonText: 'Don\'t Pre-fill Calculations',
        focusConfirm: false,
        customClass: {
          popup: 'srel-popup-prefill',
          htmlContainer: 'recommended-values',
          confirmButton: 'srel-swal-confirm',
          closeButton: 'srel-swal-close'
        },
      }).then((result) => {
        if (result.isConfirmed) {
          console.log({
            'closing_cost': closingCost,
            'down_payment': 20,
            'interest': interest_rate,
            'years': loan_term,
            'monthly_rent': 2000,
            'vacancy_rate': vacancy_rate,
            'other_monthly_income': 0,
            'management_fee': 0,
            'property_tax': propertyTax,
            'total_insurance': insuranceFee,
            'hoa_fee': 0,
            'maintenance_cost': maintenanceCost,
            'other_costs': 0,
            'value_appreciation': 3,
            'holding_length': loan_term,
            'cost_to_sell': cost_to_sell,
            'annual_rent_increase' : annual_rent_increase,
            'annual_expense_increase' : annual_expense_increase
          });
          applyInputValues({
            'closing_cost': closingCost,
            'down_payment': 20,
            'interest': interest_rate,
            'years': loan_term,
            'monthly_rent': 2000,
            'vacancy_rate': vacancy_rate,
            'other_monthly_income': 0,
            'management_fee': 0,
            'property_tax': propertyTax,
            'total_insurance': insuranceFee,
            'hoa_fee': 0,
            'maintenance_cost': maintenanceCost,
            'other_costs': 0,
            'value_appreciation': 3,
            'holding_length': loan_term,
            'cost_to_sell': cost_to_sell,
            'annual_rent_increase' : annual_rent_increase,
            'annual_expense_increase' : annual_expense_increase
          });
          // applyInputValues();
          housePrice.removeEventListener('blur', handleBlur);
        }
      })
    };
    housePrice.addEventListener('blur', handleBlur);
    ctaBtn?.addEventListener('click', evt => {
      //
      if (ctaBtn.classList.contains('disabled')) {
        evt.preventDefault();
        return;
      }
      if (typeof srel_options['force'] !== 'undefined' && srel_options['force'] == '1') {
        Swal.fire({
          title: 'Get My Property Insights Report ',
          html: sendMeACopyForm(),
          didOpen: (modalNode) => {
            modalNode.querySelectorAll('.input-wrapper').forEach(handleInputFieldInteraction);
            let form = modalNode.querySelector('form');
            form.addEventListener('submit', evt => {
              evt.preventDefault();
              let submissionBtn = form.querySelector('button.btn-result');
              let text = submissionBtn.textContent;
              submissionBtn.innerHTML = ( '<i class="fa fa-spinner fa-spin loading"></i>'+text );
              submissionBtn.setAttribute('disabled', 1);
              let rawData = new FormData(evt.target);
              let propertyCalculatedCashFlow = [...document.querySelectorAll('.results-container')].map(getPropertyCashFlow);
              rawData.append('houseAddresses', JSON.stringify([...document.querySelectorAll('.results-container h3')].map(addr => addr.textContent == 'TEST' ? '' : addr.textContent)));
              rawData.append('ratings', JSON.stringify([...document.querySelectorAll('[data-row-rating=rating]')].map(rating => rating.textContent)));
              rawData.append('housePrices', JSON.stringify([...document.querySelectorAll('.results-container .srl-h-price')].map(price => price.textContent == 'TEST' ? '$0' : price.textContent)));
              rawData.append('years' , JSON.stringify([...document.querySelectorAll('.results-container .srl-year-text')].map(year => year.textContent)));
              rawData.append('propertyCalculatedCashFlows', JSON.stringify(propertyCalculatedCashFlow));
              let userSubmissionData = formDataToJson(rawData);
              fetch(`/wp-admin/admin-ajax.php?action=df-srl-email-results-to-user`, {
                method: 'post',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(userSubmissionData),
              })
                  .then(response => {
                    if (!response.ok) {
                      throw new Error(response.body)
                    }
                    Swal.fire({
                      title: 'Email Sent',
                      html: '<p>You will receive an email containing the calculation result soon</p>',
                      allowOutsideClick :false,
                      customClass: {
                        confirmButton: 'srel-swal-confirm',
                        closeButton: 'srel-swal-close'
                      }
                    }).then(
                        function () {
                          submissionBtn.innerHTML = ( '<i class="fa fa-check"></i>' + text );
                          fetch(`/wp-admin/admin-ajax.php?action=df-srl-send-data-to-webhook`, {
                            method: 'post',
                            headers: {
                              'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(userSubmissionData),
                          })
                              .then(response => {
                                if (!response.ok) {
                                  throw new Error(response.statusText)
                                }
                                return response.json()
                              })
                              .catch(error => {
                                // console.log(error);
                              })
                          if (typeof srel_options['thank_you_page'] !== 'undefined'  && srel_options['thank_you_page'] != '')
                          {
                            window.open(srel_options['thank_you_page'], "_blank");
                          }
                          else
                          {
                            window.location.reload();
                          }
                        });
                    return response.json()
                  })
                  .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                  })
            })
          },
          willClose: () => {
            //
          },
          showCloseButton: true,
          showConfirmButton: false,
          customClass: {
            htmlContainer: 'mortgage-email-form',
            confirmButton: 'srel-swal-confirm',
            closeButton: 'srel-swal-close'
          }
        }).then((result, x) => {
          // debugger;
        })
      }
      else
      {
        var parent = ctaBtn.closest(".results-content")
        parent.querySelectorAll('.srl-div-table-col.srl-cf-blur').forEach(e => {
          e.classList.remove("srl-cf-blur");
        });
        return false;
      }
    })
    const validateMandatoryFields = evt => {
      if (evt.target.value == '') {
        let fieldWrapper = evt.target.parentElement.parentElement;
        fieldWrapper.querySelector('.srl-warning').classList.remove('srl-d-none');
      } else {
        let fieldWrapper = evt.target.parentElement.parentElement;
        fieldWrapper.querySelector('.srl-warning').classList.add('srl-d-none');
      }
    }

    const currencyInputs = this.wrapper.querySelectorAll('input[data-numeric-input="1"]');
    const requiredInputs = this.wrapper.querySelectorAll('input[required]');
    [...requiredInputs].forEach(input => {
      input.addEventListener('keyup', validateMandatoryFields)
      input.addEventListener('blur', validateMandatoryFields)
    });


    [...currencyInputs].forEach(currencyInputField => {
      currencyInputField.addEventListener('input', event => {
        addCommas(currencyInputField);
      });
    })
    function addCommas(inputField) {
      let val = inputField.value.replace(/\D/g, ""); // remove any non-digit characters
      val = parseInt(val, 10); // convert to integer
      if (isNaN(val)) {
          // if the input value is not a valid number, empty the input field
          inputField.value = "";
      } else {
          // if the input value is a valid number, format it with commas
          inputField.value = val.toLocaleString('en-US');
      }
  }
    function removeCommas(value) {
      let val = value.replace(/,/g, ""); // remove all commas from the value
      return parseInt(val); // update the input field with the new value
    }
    function returnCommaValue(value) {
      let val = value.replace(/\D/g, ""); // remove any non-digit characters
      val = parseInt(val, 10); // convert to integer
      if (isNaN(val)) {
          // if the input value is not a valid number, empty the input field
          val = "";
      } else {
          // if the input value is a valid number, format it with commas
          val = val.toLocaleString('en-US');
      }
      return val;
  }
    function calculate() {
      let insurance = .001;
      let taxes = .001;
      function getTotal(principle, payment) {
        // return ((((principle * interestRateM) / (1 - Math.pow(1 + interestRateM, (-1 * months))) * 100) / 100) + insuranceMonthly + taxesMonthly + payment);
        return ((((principle * interestRateM) / (1 - Math.pow(1 + interestRateM, (-1 * months))) * 100) / 100) + insuranceMonthly + payment);

      }
      var numYears = parseInt(getInputFieldValue(years));
      var principle = getInputFieldValue(housePrice) - (getInputFieldValue(housePrice) * (getInputFieldValue(downPayment) / 100));
      var interestRateM = getInputFieldValue(interestRate) / (100 * 12);
      var months = numYears * 12;
      var monthlyPayment = ((principle * interestRateM) / (1 - Math.pow(1 + interestRateM, -1 * months)) * 100) / 100;
      var insuranceMonthly = insurance / 12;
      // var taxesMonthly = taxaes / 12;

      var fhaPrinciple = principle + (principle * 0.0175);
      var fhaPayment;
      if (numYears === 15) {
        if (getInputFieldValue(downPayment) >= 10) {
          fhaPayment = ((fhaPrinciple * 0.0025) / 12);
        } else if (getInputFieldValue(downPayment) < 10) {
          fhaPayment = ((fhaPrinciple * 0.0050) / 12);
        }
      } else if(numYears === 30) {
        if (getInputFieldValue(downPayment) >= 5) {
          fhaPayment = ((fhaPrinciple * 0.0055) / 12);
        } else if (getInputFieldValue(downPayment) < 5) {
          fhaPayment = ((fhaPrinciple * 0.0060) / 12);
        }
      }

      var fhaTotal;
      if (getInputFieldValue(downPayment) >= 3.5) {
        fhaTotal = getTotal(fhaPrinciple, fhaPayment);
        // $("input[name=fha]").val(fhaTotal.toFixed(2));
      } else {
        // $("input[name=fha]").val("3.5% down required");
      }

      var vaPrinciple;
      if (getInputFieldValue(downPayment) >= 10) {
        vaPrinciple = (principle * 1.0125);
      } else if (getInputFieldValue(downPayment) >= 5 && getInputFieldValue(downPayment) < 10) {
        vaPrinciple = (principle * 1.015);
      } else {
        vaPrinciple = (principle * 1.0215);
      }
      var vaTotal = getTotal(vaPrinciple, 0);
      // $("input[name=va]").val(vaTotal.toFixed(2));

      var usdaPrinciple = principle + (principle * 0.01);
      var usdaPayment = (usdaPrinciple * 0.0035) / 12;
      var usdaTotal = getTotal(usdaPrinciple, usdaPayment);
      // $("input[name=usda]").val(usdaTotal.toFixed(2));

      var convPayment;
      if (getInputFieldValue(downPayment) >= 3 && getInputFieldValue(downPayment) < 5) {
        convPayment = (principle * 0.0062) / 12;
      } else if (getInputFieldValue(downPayment) >= 5 && getInputFieldValue(downPayment) < 10) {
        convPayment = (principle * 0.0052) / 12;
      } else if (getInputFieldValue(downPayment) >= 10 && getInputFieldValue(downPayment) < 15) {
        convPayment = (principle * 0.0030) / 12;
      } else if (getInputFieldValue(downPayment) >= 15 && getInputFieldValue(downPayment) < 20) {
        convPayment = (principle * 0.0019) / 12;
      } else if (getInputFieldValue(downPayment) >= 20 && getInputFieldValue(downPayment) <= 100) {
        convPayment = 0;
      }

      var convTotal;
      if (getInputFieldValue(downPayment) >= 3) {
        // convTotal = monthlyPayment + insuranceMonthly + taxesMonthly + convPayment;
        convTotal = monthlyPayment + insuranceMonthly  + convPayment;

        // $("input[name=conv]").val(convTotal.toFixed(2));
        let income = Number(getInputFieldValue(incomeInput));
        let annualRentIncrease = Number(getInputFieldValue(annualRentIncreaseInput));
        let annualExpenseIncrease = Number(getInputFieldValue(annualExpenseIncreaseInput));
        let incomeInclusiveOther = income + Number(getInputFieldValue(otherIncomeInput));
        let vacancy = income * (Number(getInputFieldValue(vacancyInput)) / 100);
        let propertyTax = Number(getInputFieldValue(propertyTaxInput));
        let insurance = Number(getInputFieldValue(totalInsuranceInput));
        let hoaFee = Number(getInputFieldValue(hoaFeeInput));
        let maintenance = Number(getInputFieldValue(maintenanceCostInput));
        let otherCost = Number(getInputFieldValue(otherCostInput));
        let managementFee = (incomeInclusiveOther - vacancy) * (Number(getInputFieldValue(managementFeeInput) / 100));
        let holdingLength = Number(getInputFieldValue(holdingLengthInput));
        let valueAppreciation = Number(getInputFieldValue(valueAppreciationInput));
        let closingCost = Number(getInputFieldValue(closingCostInput));
        let costToSell = (Number(getInputFieldValue(housePrice)))*(Number(getInputFieldValue(costToSellInput))/100);

        numYearsText.textContent = numYears;
        let totalIncome = annualIncreasedPrice(incomeInclusiveOther, annualRentIncrease, numYears)
        console.log(incomeInclusiveOther);
        printValueInResultBox(incomeRow, incomeInclusiveOther, incomeInclusiveOther * 12, totalIncome);
        printValueInResultBox(vacancyRow, vacancy, vacancy * 12, numYears * ( vacancy * 12 ));
        let propertyTaxIncreased = annualIncreasedPrice(propertyTax/12, annualExpenseIncrease, numYears)
        printValueInResultBox(propertyTaxRow, propertyTax/12, propertyTax, propertyTaxIncreased);
        let insuranceTaxIncreased = annualIncreasedPrice(insurance/12, annualExpenseIncrease, numYears)
        printValueInResultBox(totalInsuranceRow, insurance/12, insurance, insuranceTaxIncreased);
        let hoaFeeIncreased = annualIncreasedPrice(hoaFee/12, annualExpenseIncrease, numYears)
        printValueInResultBox(hoaFeeRow, hoaFee/12, hoaFee, hoaFeeIncreased);
        // printValueInResultBox(hoaFeeRow, 0, 0, 0);
        let maintenanceTaxIncreased = annualIncreasedPrice(maintenance/12, annualExpenseIncrease, numYears)
        printValueInResultBox(maintenanceCostRow, maintenance/12, maintenance, maintenanceTaxIncreased);
        // printValueInResultBox(maintenanceCostRow, 0, 0, 0);
        let otherCostIncreased = annualIncreasedPrice(otherCost/12, annualExpenseIncrease, numYears)
        printValueInResultBox(otherCostRow, otherCost/12, otherCost, otherCostIncreased);
        // printValueInResultBox(otherCostRow, 0, 0, 0);
        printValueInResultBox(mortgagePayRow, convTotal, convTotal * 12, numYears * ( convTotal * 12 ));
        printValueInResultBox(managementFeeRow, managementFee, managementFee * 12, numYears * (managementFee * 12));

        // Cash Flow calculation
        const cashFlow = (incomeInclusiveOther * 12) - (vacancy *12) - (convTotal * 12) - ( propertyTax + insurance + hoaFee + maintenance + otherCost );
        // storeCFValueInResultBox(cashFlowRow, cashFlow/12, cashFlow);
        ratingElement.textContent = getRating(cashFlow/12);
        printValueInResultBox(cashFlowRow, cashFlow/12, cashFlow, numYears * cashFlow);
        // printValueInResultBox(cashFlowRow, 0, 0, 0);

        // NOI calculation
        const noi = (incomeInclusiveOther * 12) - ( propertyTax + insurance + hoaFee + maintenance + otherCost ) - (vacancy *12);
        // storeCFValueInResultBox(noiRow, noi/12, noi);
        printValueInResultBox(noiRow, noi/12, noi, numYears * noi);
        // printValueInResultBox(noiRow, 0, 0, 0);
        printValueInResultBox(capRateRow,0 , 0, (numYears * noi)/getInputFieldValue(housePrice));
        const sp = calculateTotalSellingPrice(Number(getInputFieldValue(housePrice)), holdingLength, valueAppreciation);
        printValueInResultBox(sellingPriceRow,0 , 0, sp);
        const tp = getTotalProfit(sp, closingCost,cashFlow, costToSell, (Number(getInputFieldValue(housePrice)))*(Number(getInputFieldValue(downPayment))/100));
        printValueInResultBox(totalProfitRow,0 , 0, tp);
        // Detecting if any of the input fields have warnings
        const inputFieldsWithWarnings = document.querySelectorAll('.srl-warning:not(.srl-d-none)');
        // ctaBtn.classList.remove('disabled');
        if (inputFieldsWithWarnings.length > 0) {
          window.scrollTo(0, srlGetOffset(inputFieldsWithWarnings[0]).top - 80)
        } else {
          window.scrollTo(0, srlGetOffset(housePriceDisplay).top - 80);
          Swal.fire(
              {
                text : 'Success',
                icon : 'success',
                customClass: {
                  confirmButton: 'srel-swal-confirm',
                  closeButton: 'srel-swal-close'
                }
              }
          );
        }

      } else {

        const inputFieldsWithWarnings = document.querySelectorAll('.srl-warning:not(.srl-d-none)');
        printValueInResultBox(incomeRow, 0, 0,  0);
        printValueInResultBox(vacancyRow, 0, 0,  0);
        printValueInResultBox(propertyTaxRow, 0, 0,  0);
        printValueInResultBox(totalInsuranceRow, 0, 0,  0);
        printValueInResultBox(hoaFeeRow, 0, 0,  0);
        printValueInResultBox(maintenanceCostRow, 0, 0,  0);
        printValueInResultBox(otherCostRow, 0, 0,  0);
        printValueInResultBox(mortgagePayRow, 0, 0,  0);
        printValueInResultBox(managementFeeRow, 0, 0,  0);
        printValueInResultBox(cashFlowRow, 0, 0,  0);
        printValueInResultBox(noiRow, 0, 0,  0);
        if (houseAddr.value == ''){
          resultTitle.textContent = ''
          mainTabBox.querySelector(".srel-tab-button.active").textContent = formatPropertyName(mainTabBox.querySelector(".srel-tab-button.active").getAttribute('data-id'));
        }
        if (housePrice.value == 0)
        {
          housePriceDisplay.classList.add('srl-d-none');
        }
        numYearsText.textContent = 0;
        ratingElement.textContent = 'F' ;
        if (inputFieldsWithWarnings.length > 0) {
          window.scrollTo(0, srlGetOffset(inputFieldsWithWarnings[0]).top - 80)
        }
        // $("input[name=conv]").val("3% down required");
      }
    }
  }
}
function annualIncreasedPrice(number, annual_increase, years)
{
  let totalValue = 0;
  let monthlyValue = number;
  const annualIncreaseRate = (annual_increase/100);
  for (let year = 1; year <= years; year++) {
    const yearlyRent = monthlyValue * 12;
    totalValue += yearlyRent;
    monthlyValue += monthlyValue * annualIncreaseRate;
  }
  return totalValue;
}
function calculateTotalSellingPrice(initialPrice, yearsOfHolding, appreciationRate) {
  // Convert the appreciation rate to a decimal.
  appreciationRate = appreciationRate / 100;

  // Calculate the total appreciation.
  totalAppreciation = initialPrice * appreciationRate * yearsOfHolding;

  // Calculate the total selling price.
  totalSellingPrice = initialPrice + totalAppreciation;

  return totalSellingPrice;
}
function getTotalProfit(totalSellingPrice, closingCost, cashFlow, costToSell, downPayment) {
  // Calculate the profit from the sale of the property.
  var profitFromSale = totalSellingPrice - closingCost - costToSell;

  // If the cash flow is positive, add it to the profit from the sale.
  if (cashFlow > 0) {
    profitFromSale += cashFlow;
  } else {
    // If the cash flow is negative, subtract it from the profit from the sale.
    profitFromSale -= cashFlow;
  }

  // Add back the down payment.
  profitFromSale -= downPayment;

  return profitFromSale;
}
function srlGetOffset(el) {
  const rect = el.getBoundingClientRect();
  return {
    left: rect.left + window.scrollX,
    top: rect.top + window.scrollY,
  };
}
var mainTabBox = document.querySelector('#srel-container .srel-property-tabs');
const mainResultBox = document.querySelector('.srel-results.srl-right-container .results-container');
const instanceOne = new CalculationForm(document.querySelector('.first-property'));
const resultBoxTemplate = mainResultBox.parentElement.innerHTML;
instanceOne.applyCalc();