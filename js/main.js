var SP_HEIGHT = 768

/**
 * 初始化
 */
var init = function () {
    // banner高度
    var bannerH
    document.querySelectorAll('.index-header, .inner-header').forEach(function (ele) {
        bannerH = window.screen.height / 2 - 100
        ele.style.height = bannerH + "px"
    })

    // to-top
    var toTop = document.querySelector('#to-top')
    toTop.onclick = function () {
        window.scrollTo({ 
            top: 0, 
            behavior: "smooth" 
        })
    }

    // 手机端顶部导航按钮
    if(window.screen.width < SP_HEIGHT) {
        var mainBlock = document.querySelector('main')
        var topNavActBtn = document.querySelector('.top-nav-sp__btn')
        var topNavRealBtn = topNavActBtn.querySelector('.top-nav-btn')
        var topNavDrawer = document.querySelector('.top-nav-sp__drawer')
        
        topNavActBtn.onclick = function () {
            if(topNavRealBtn.classList.contains('top-nav-btn__close')) {
                topNavRealBtn.classList.remove('top-nav-btn__close')
                topNavDrawer.style.right = '-50%'
                mainBlock.classList.remove('mask')
            } else {
                topNavRealBtn.classList.add('top-nav-btn__close')
                topNavDrawer.style.right = '0px'
                mainBlock.classList.add('mask')
            }
        }
    }

    // 数据
    var Model = {
        winObj: {
            prevScrollTop: win.scrollTop
        },
        scroll: {
            // 顶部导航
            topNav: {
                el: document.querySelector('#top-nav-pc'),
                defHeight: 80,
                fixedClsName: "top-nav-pc__fixed",
                debounce: true,
                handler: topNavScrollEvent
            },
            topNavSp: {
                el: document.querySelector('#top-nav-sp').querySelector('.top-nav-btn'),
                bannerHeight: bannerH,
                changeClsName: "top-nav-btn__dark",
                handler: topNavSpScrollEvent
            },
            toTop: {
                el: toTop,
                handler: toTopEvent
            }
        }
    }

    // 滚动事件
    var postNav = document.querySelector('#post-nav')
    var postNavItems = postNavItemsInit(document.querySelector('#post-main-section'), postNav)

    if (postNavItems.length) {
        Model.scroll.postNav = {
            el: postNav,
            defOffsetHeight: postNav && postNav.getBoundingClientRect().top + win.scrollTop,
            fixedClsName: "post-menu__fixed",
            fixedTop: 120,
            items: postNavItems,
            itemActiveClsName: 'post-nav-item__current',
            itemHideClsName: 'post-nav-item__hidden',
            handler: postNavScrollEvent
        }
    }

    addScrollEvent.call(Model)
}

/**
 * 文章菜单初始化
 */
var postNavItemsInit = function (postText, postNav) {
    if (!postText) return []
    var navNodes = Array.from(postText.querySelectorAll('h1,h2,h3,h4,h5,h6'))
    if(!navNodes.length) return []

    var titleNode, postMenuNav
    titleNode = document.createElement('div')
    titleNode.classList.add('post-menu__title')
    titleNode.innerText = '文章目录'
    postMenuNav = document.createElement('div')
    postMenuNav.classList.add('post-menu__nav')
    postNav.appendChild(titleNode)
    postNav.appendChild(postMenuNav)

    if(!titleNode || !postMenuNav) return []

    return navNodes.map(function (pNode, index) {
        var navItemLevel = parseInt(pNode.tagName.split('H')[1])

        var navItem
        navItem = document.createElement('div')
        navItem.classList.add('post-nav-item')
        navItem.classList.add('post-nav-item__' + navItemLevel)
        navItem.innerText = pNode.innerText
        postMenuNav.appendChild(navItem)
        
        Object.defineProperty(navItem, 'sTop', {
            get() {
                return pNode.getBoundingClientRect().top + win.scrollTop - window.screen.height / 3 + 100
            }
        })
        navItem.addEventListener('click', function () {
            window.scrollTo({ 
                top: this.sTop, 
                behavior: "smooth" 
            })
        })

        return {
            postNode: pNode,
            navNode: navItem,
            level: navItemLevel,
            get scrollTop() {
                return pNode.getBoundingClientRect().top + win.scrollTop - window.screen.height / 3 + 100
            },
            set active (status) {
                this.navNode.classList[status ? 'add' : 'remove']('post-nav-item__current')
            } 
        }
    })
}

/**
 * 顶部导航滚动处理
 */
 var topNavScrollEvent = function () {
    var isScrollUp = this.prevScrollTop - win.scrollTop >= 0
    if (win.scrollTop > 0 && isScrollUp) {
        this.el.style.top = "0px"
        this.el.classList.add(this.fixedClsName)
    }
    if (win.scrollTop <= 0) {
        this.el.classList.remove(this.fixedClsName)
    }
    if (!isScrollUp) {
        this.el.style.top = -1 * this.defHeight + "px"
    }
}
var topNavSpScrollEvent = function () {
    if (window.screen.width < SP_HEIGHT) {
        if (win.scrollTop > this.bannerHeight) {
            this.el.classList.add(this.changeClsName)
        } else {
            this.el.classList.remove(this.changeClsName)
        }
    }
}

var toTopEvent = function () {
    if (win.scrollTop > window.screen.height * 0.66) {
        this.el.style.right = "5%"
    } else {
        this.el.style.right = "-60px"
    }
}

/**
 * 文章菜单滚动处理
 */
var postNavScrollEvent = function () {
    var d = this.defOffsetHeight - this.fixedTop
    if (win.scrollTop > d) {
        this.el.classList.add(this.fixedClsName)
    } else {
        this.el.classList.remove(this.fixedClsName)
    }

    // 找到当前激活最小层级
    var curNavItem = this.items[0], curNavItemIdx = 0
    var maxLevel = 6
    for(var i = 0; i < this.items.length; i++) {
        if (win.scrollTop + 5 >= this.items[i].scrollTop) {
            curNavItem = this.items[i]
            curNavItemIdx = i
        }
        maxLevel = Math.min(maxLevel, this.items[i].level)
    }
    if(curNavItem && curNavItemIdx >= 0) {
        var prevLevel = 0
        var parentNavItems = []
        this.items.forEach(function (_postNavItem, _idx) {
            _postNavItem.active = true
            if (_idx > curNavItemIdx) {
                // 最小层级判定目录后面的全部取消
                _postNavItem.active = false
            } else {
                // 检查过去已激活标题
                for(var i = 0; i < parentNavItems.length; i++) {
                    // 过去标题层级 小于 当前的全部取消
                    if (parentNavItems[i].level >= _postNavItem.level) {
                        parentNavItems[i].active = false
                        parentNavItems.splice(i, 1)
                        i -= 1
                    }
                }
                parentNavItems.push(_postNavItem)
            }
            prevLevel = _postNavItem.level
        }.bind(this))
    }
    
    // 文章菜单显示隐藏
    if (this.items.length) {
        var targetLevel = this.items[curNavItemIdx].level
        this.items[curNavItemIdx].navNode.classList.remove(this.itemHideClsName)
        var curIdx = Math.min(this.items.length - 1, curNavItemIdx + 1)
        var mLevel = targetLevel
        for(var i = curIdx; i < this.items.length; i++) {
            if(mLevel < this.items[i].level) {
                this.items[i].navNode.classList.add(this.itemHideClsName)
            }
            mLevel = Math.min(this.items[i].level, mLevel)
        }
        var isOverSameLevel = false
        for(i = curIdx; i < this.items.length; i++) {
            if(this.items[i].level < targetLevel) {
                break
            }
            if(targetLevel == this.items[i].level) {
                this.items[i].navNode.classList.remove(this.itemHideClsName)
                isOverSameLevel = true
            }
            // 经过同一level后不能展开更低level的菜单
            if(!isOverSameLevel && targetLevel + 1 == this.items[i].level) {
                this.items[i].navNode.classList.remove(this.itemHideClsName)
            }
        }
        curIdx = Math.max(0, curNavItemIdx - 1)
        mLevel = targetLevel
        for(i = curIdx; i > 0; i--) {
            if(mLevel < this.items[i].level) {
                this.items[i].navNode.classList.add(this.itemHideClsName)
            }
            mLevel = Math.min(this.items[i].level, mLevel)
        }
        for(i = curIdx; i > 0; i--) {
            if(this.items[i].level < targetLevel) {
                break
            }
            if(targetLevel == this.items[i].level) {
                this.items[i].navNode.classList.remove(this.itemHideClsName)
            }
        }
    }
    
}

/**
 * 滚动监听
 */
var addScrollEvent = function () {
    winScrollHandler.call(this)
    window.addEventListener('scroll', winScrollHandler.bind(this))
}
var winScrollHandler = function () {
    for (var eventName in this.scroll) {
        if(this.scroll[eventName] && this.scroll[eventName].el && this.scroll[eventName].handler) {
            this.scroll[eventName].handler.call(Object.assign(this.scroll[eventName], this.winObj))
        }
    }
    this.winObj.prevScrollTop = win.scrollTop
}

var win = {
    get scrollTop() {
        return document.documentElement.scrollTop
    }
}

var debounce = function(fn, delay = 500) {
    var timer = null
    return function (...args) {
        if(timer) clearTimeout(timer)
        timer = setTimeout(function () {
            fn.call(this, ...args)
        }.bind(this), delay)
    }
}