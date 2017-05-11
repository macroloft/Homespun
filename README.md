# Homespun
Homespun is intended to help making reusable components out of recurring HTML snippets. Considered from distance it works a bit like the view part of components in well known JavaScript SPA frameworks. It's actually in early development and primary a research and learning project. Homespun should help getting things done quickly and (hopefully) clean.

Actually Homespun is mainly used in local dummy applications and is not tested for safety, so **I do not recommend to use it in productive applications** *(atm)*.

## Installation
You can get Homespun via [Composer](http://getcomposer.org)

```
tbd
```

## History or Explanation
For some time now I'm searching for a nifty solution to make parts of my HTML code reusable. As short background: In my daily business I work on big simulation/mockup/dummy projects with partially often repeating elements with just tiny differences.

With [Bootstrap](http://getbootstrap.com) as an example, let's say we have the ```.btn``` component with its different context colors. Now usually we have to write the complete HTML code with its elements and attributes over and over again in our project everywhere we want to place a button. In the beginning we may try to establish a coding/order convention. But, let's be honest, in the end the spelling will differ in many/most cases. Right if you work in a bigger team. One time the ```class``` attribute comes first, other times the ```type``` declaration. In the first three cases we have a specific class order (let's say ```btn btn-block btn-default```) and in all other cases it is totally random (```btn-block btn btn-primary``` or whatever).

These little things annoy the shit out of me. And, by the way (honestly, it's a major reason on the other hand), it's hard to *find & replace* those parts. I'm a person which loves and wants recurring patterns wherever it's useful. And this is one reason for Homespun. Sometimes it happens that a component construction changes heavily. Without Homespun in bad times you have to go through your entire code and replace everything by hand. With Homespun you go to your central template file and change everything needed in one place. Done! Cool.

Homespun is the fourth approach to find the best (at least a good) workflow for managing snippets in one general place. There are three other working drafts from less powerful to more complex. The first solution is most used until now but has historically grown. The second approach was super complex and tidy to maintain. No real help! After that I came back to the roots and created a *simpler than ever* solution which has its own charm. Finally with Homespun I think I hit the middle way, took the benefits of all three earlier drafts and combined them into a new shimmering garment. Let's see how things will evolve.
