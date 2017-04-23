git smart update
====================
2017-04-23



This php script helps me pushing a project to the public repository.




Motivation
============

I found myself doing a lot of git pushing recently.

I have a routine, which consists of putting the history log at the end of my README file.

Then, when comes the time to push to git, I generally use my [super duper shortcuts](https://github.com/lingtalfi/my-git-config).

So for instance, if my project just went into version 1.2.0, with the commit text "add feature XXX",
then I would generally do this:


```bash
cd /my/project
git snap add feature XXX
git t 1.2.0
git pp
```

And that would be it.

However, this can be improved, and be turned into this:

```bash
cd /my/project
gsu
```

That's because I've already typed the version number and the commit text in my README, and I use a consistent format,
so that can be automated, and this is the purpose of this project.


So I created the **smart-update.php** script.

And now to use it you can adapt it to your projects first, and then to the alias:

```bash
alias gsu='php -f /myphp/git-smart-update/smart-update.php'
```


Enjoy!



Ps: if you like my shortcuts, you can use the guu shortcut for projects where the version number doesn't matter.
See all [my aliases here](https://github.com/lingtalfi/myaliases).














