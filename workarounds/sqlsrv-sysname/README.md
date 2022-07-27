Adds `SYSNAME` type support to DBAL, required for model generator to run
properly.

Considered to be temporal fix at the moment (2018-12-03) due to it's
ugliness. I'm going to create an own brand new model generator package
(actually, not so much work left there), but I also don't want to write
boilerplate code with my hands before model generator is ready.

Applied with
```
$ ./workarounds/sqlsrv-sysname/apply.sh
```